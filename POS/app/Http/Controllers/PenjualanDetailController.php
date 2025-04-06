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
        $detail = PenjualanDetailModel::select('penjualan_detail_id', 'penjualan_id', 'barang_id', 'jumlah', 'harga');

        return DataTables::of($detail)
            ->addIndexColumn()
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
        $penjualan = PenjualanModel::findOrFail($id);
    
        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list'  => ['Home', 'Penjualan', 'Edit']
        ];
    
        $page = (object) [
            'title' => 'Edit transaksi penjualan'
        ];
    
        $activeMenu = 'penjualan';
    
        return view('penjualan.edit', compact('breadcrumb', 'page', 'penjualan', 'activeMenu'));
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

