<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Data Penjualan',
            'list' => ['Home', 'Penjualan']
        ];
    
        $page = (object) [
            'title' => 'Daftar transaksi Penjualan'
        ];
    
        $activeMenu = 'penjualan';
        $penjualan = PenjualanModel::all(); // Tambahkan ini untuk mengambil data
    
        return view('penjualan.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu,
            'penjualan' => $penjualan // Kirim data ke view
        ]);
    }
    
    // public function list(Request $request)
    // {
    //     $penjualan = PenjualanModel::select('penjualan_id', 'penjualan_kode', 'pembeli', 'penjualan_tanggal');

    //     return DataTables::of($penjualan)
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function ($penjualan) {
    //             $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<a href="' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
    //             $btn .= '<form class="d-inline-block" method="POST" action="' .
    //                 url('/penjualan/' . $penjualan->penjualan_id) . '">'
    //                 . csrf_field() . method_field('DELETE') .
    //                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi'])
    //         ->make(true);
    // }

    public function list(Request $request)
{
    $data = PenjualanModel::query();

    if ($request->customer_id) {
        $data->where('customer_id', $request->customer_id);
    }

    return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($row) {
            return '
            <a href="' . url("penjualan/$row->penjualan_id") . '" class="btn btn-info btn-sm mr-1">Detail</a>
            <button onclick="modalAction(\'' . url("penjualan/$row->penjualan_id/show_ajax") . '\')" class="btn btn-outline-info btn-sm mr-1" title="Detail">
                <i class="fa fa-eye"></i>
            </button>

            <a href="' . url("penjualan/$row->penjualan_id/edit") . '" class="btn btn-warning btn-sm mr-1">Edit</a>
            <button onclick="modalAction(\'' . url("penjualan/$row->penjualan_id/edit_ajax") . '\')" class="btn btn-outline-warning btn-sm mr-1" title="Edit">
                <i class="fa fa-edit"></i>
            </button>

            <form method="POST" action="' . url("penjualan/$row->penjualan_id") . '" style="display:inline;" onsubmit="return confirm(\'Yakin hapus data?\')">
                ' . csrf_field() . method_field('DELETE') . '
                <button class="btn btn-danger btn-sm mr-1">Delete</button>
            </form>

            <button onclick="modalAction(\'' . url("penjualan/$row->penjualan_id/delete_ajax") . '\')" class="btn btn-outline-danger btn-sm" title="Delete">
                <i class="fa fa-trash"></i>
            </button>
        ';
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah transaksi penjualan'
        ];

        $barang = BarangModel::all();
        $activeMenu = 'penjualan';

        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_kode' => 'required',
            'pembeli' => 'required',
            'penjualan_tanggal' => 'required|date',
        ]);
    
        PenjualanModel::create([
            'penjualan_kode' => $request->penjualan_kode,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);
    
        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    
    public function show(string $id)
    {
        $penjualan = PenjualanModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list'  => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Data penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penjualan' => $penjualan,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        $penjualan = PenjualanModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list'  => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit transaksi penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'total' => 'required|numeric'
        ]);

        PenjualanModel::find($id)->update([
            'tanggal' => $request->tanggal,
            'total' => $request->total
        ]);

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = PenjualanModel::find($id);
        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            PenjualanModel::destroy($id);
            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terkait dengan data lain');
        }
    }

    public function create_ajax()
    {
        return view('penjualan.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'penjualan_kode' => 'required',
                'pembeli' => 'required',
                'penjualan_tanggal' => 'required|date',
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
    
            PenjualanModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan',
            ]);
        }
    
        return redirect('/')->with('success', 'Data user berhasil disimpan');
    }
    
    public function show_ajax($id)
    {
        $penjualan = PenjualanModel::find($id);
        return view('penjualan.show_ajax', compact('penjualan'));
    }

    public function edit_ajax(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        return view('penjualan.edit_ajax', compact('penjualan'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'penjualan_kode' => 'required|string|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_id',
                'pembeli' => 'required|string',
                'penjualan_tanggal' => 'required|date',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = PenjualanModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }

}