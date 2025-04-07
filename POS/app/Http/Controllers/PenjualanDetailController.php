<?php

namespace App\Http\Controllers;

use App\Models\PenjualanDetailModel;
use App\Models\BarangModel;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
    
        return view('penjualan_detail.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'detail' => $detail // Kirim data ke view
        ]);
    }
    

    public function list(Request $request)
    {
        $query = PenjualanDetailModel::query();
        
        if ($request->has('pembeli') && $request->pembeli != '') {
            $query->where('pembeli_id', $request->pembeli); // Sesuaikan dengan kolom yang relevan
        }
    
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('total', function ($detail) {
                return number_format($detail->jumlah * $detail->harga);
            })
            ->addColumn('aksi', function ($detail) {
                $btn = '<a href="' . url('/penjualan_detail/' . $detail->penjualan_detail_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/penjualan_detail/' . $detail->penjualan_detail_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan_detail/' . $detail->penjualan_detail_id) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


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
        $barangs = BarangModel::all();

        return view('penjualan_detail.create', compact('breadcrumb', 'page', 'activeMenu', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:m_penjualan,id',
            'barang_id' => 'required|exists:m_barang,id',
            'jumlah' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);

        PenjualanDetailModel::create($request->all());

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
}

