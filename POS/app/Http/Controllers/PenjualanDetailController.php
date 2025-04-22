<?php

namespace App\Http\Controllers;

use App\Models\PenjualanDetailModel;
use App\Models\BarangModel;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PenjualanDetailController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];
    
        $page = (object) [
            'title' => 'Daftar semua detail transaksi penjualan'
        ];
    
        $activeMenu = 'penjualan';
    
        $detail = PenjualanDetailModel::all(); // Ambil semua data penjualan detail
        $barang = BarangModel::all(); // Ambil semua barang untuk filter
    
        return view('penjualan_detail.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'detail' => $detail,
            'barang' => $barang, // Tambahkan ini
        ]);
    }
    
    public function list(Request $request)
    {
        $query = PenjualanDetailModel::with(['penjualan', 'barang']); // Tambahkan eager loading
    
        if ($request->has('barang') && $request->barang != '') {
            $query->where('barang_id', $request->barang);
        }
    
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('total', function ($detail) {
                return number_format($detail->jumlah * $detail->harga);
            })
            ->addColumn('aksi', function ($detail) {
                $btn = '<a href="' . url("penjualan_detail/$detail->detail_id") . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url("penjualan_detail/$detail->detail_id/edit") . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan_detail/' . $detail->detail_id) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    
    

    // public function list(Request $request)
    // {
    //     $data = PenjualanDetailModel::with('barang', 'penjualan');

    //     if ($request->barang_id) {
    //         $data->where('barang_id', $request->barang_id);
    //     }

    //     return datatables()->of($data)
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function($row) {
    //             return '
    //                 <a href="' . url("penjualan_detail/$row->detail_id") . '" class="btn btn-info btn-sm mr-1">Detail</a>
    //                 <button onclick="modalAction(\'' . url("penjualan_detail/$row->detail_id/show_ajax") . '\')" class="btn btn-outline-info btn-sm mr-1" title="Detail">
    //                     <i class="fa fa-eye"></i>
    //                 </button>

    //                 <a href="' . url("penjualan_detail/$row->detail_id/edit") . '" class="btn btn-warning btn-sm mr-1">Edit</a>
    //                 <button onclick="modalAction(\'' . url("penjualan_detail/$row->detail_id/edit_ajax") . '\')" class="btn btn-outline-warning btn-sm mr-1" title="Edit">
    //                     <i class="fa fa-edit"></i>
    //                 </button>

    //                 <form method="POST" action="' . url("penjualan_detail/$row->detail_id") . '" style="display:inline;" onsubmit="return confirm(\'Yakin hapus data?\')">
    //                     ' . csrf_field() . method_field('DELETE') . '
    //                     <button class="btn btn-danger btn-sm mr-1">Delete</button>
    //                 </form>

    //                 <button onclick="modalAction(\'' . url("penjualan_detail/$row->detail_id/delete_ajax") . '\')" class="btn btn-outline-danger btn-sm" title="Delete">
    //                     <i class="fa fa-trash"></i>
    //                 </button>
    //             ';
    //         })
    //         ->rawColumns(['aksi'])
    //         ->make(true);
    // }


    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];
    
        $page = (object) [
            'title' => 'Form tambah detail penjualan'
        ];
    
        $activeMenu = 'penjualan';
    
        $barang = BarangModel::all();
    
        return view('penjualan_detail.create', compact('breadcrumb', 'page', 'activeMenu', 'barang'));
    }    
    

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:t_penjualan,penjualan_id',
            'barang_id' => 'required|exists:m_barang,barang_id',
            'jumlah' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:0',
        ]);
    
        // Simpan data penjualan detail
        PenjualanDetailModel::create([
            'penjualan_id' => $request->penjualan_id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total' => $request->jumlah * $request->harga,
        ]);
    
        return redirect()->route('penjualan_detail.index')->with('success', 'Detail penjualan berhasil ditambahkan');
    }
 

    public function show($id)
    {
        $detail = PenjualanDetailModel::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Detail Data',
            'list' => ['Home', 'Penjualan', 'Detail', 'Lihat']
        ];

        $page = (object) [
            'title' => 'Lihat detail data penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan_detail.show', compact('breadcrumb', 'page', 'activeMenu', 'detail'));
    }

    public function edit(string $id)
    {
        $detail = PenjualanDetailModel::findOrFail($id);
    
        $breadcrumb = (object) [
            'title' => 'Edit Detail Penjualan',
            'list'  => ['Home', 'Penjualan', 'Edit']
        ];
    
        $page = (object) [
            'title' => 'Edit Detail Penjualan'
        ];
    
        $activeMenu = 'penjualan';
    
        return view('penjualan_detail.edit', compact('breadcrumb', 'page', 'detail', 'activeMenu'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:m_barang,id',
            'jumlah' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);

        $detail = PenjualanDetailModel::findOrFail($id);
        $detail->update($request->all());

        return redirect()->route('penjualan_detail.index')->with('success', 'Detail penjualan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $detail = PenjualanDetailModel::findOrFail($id);
        $detail->delete();

        return redirect()->route('penjualan_detail.index')->with('success', 'Detail penjualan berhasil dihapus');
    }

    public function create_ajax()
    {
        $barang = BarangModel::all();
        $penjualan = PenjualanModel::all();

        return view('penjualan_detail.create_ajax', compact('barang', 'penjualan'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'penjualan_id' => 'required|integer',
                'barang_id'    => 'required|integer',
                'jumlah'       => 'required|numeric|min:1',
                'harga'        => 'required|numeric|min:0',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            PenjualanDetailModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan',
            ]);
        }

        return redirect('/');
    }


}

