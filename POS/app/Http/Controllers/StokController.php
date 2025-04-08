<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\BarangModel;
use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok Barang',
            'list' => ['Home', 'Stok']
        ];
    
        $page = (object) [
            'title' => 'Data Stok Barang'
        ];
    
        $activeMenu = 'stok';
    
        $stok = StokModel::all();
        $barang = BarangModel::all(); // Tambahkan baris ini untuk ambil data barang
    
        return view('stok.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'stok' => $stok,
            'barang' => $barang // Kirim variabel ke view
        ]);
    }    

    

    public function list(Request $request)
    {
        $query = \App\Models\StokModel::query();
    
        if ($request->barang) {
            $query->where('barang_id', $request->barang);
        }
    
        return DataTables::of($query)
            ->addColumn('aksi', function ($row) {
                $btn = '<a href="' . route('stok.show', $row->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . route('stok.edit', $row->stok_id) . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form action="' . route('stok.destroy', $row->stok_id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin?\')">Hapus</button>
                         </form>';
                return $btn;
            })
            ->rawColumns(['aksi']) 
            ->addIndexColumn()     
            ->make(true);
    }
    
    

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Stok'
        ];

        $barang = BarangModel::all();
        $supplier = SupplierModel::all();
        $activeMenu = 'stok';

        return view('stok.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'supplier' => $supplier,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'stok_jumlah' => 'required|numeric',
            'stok_tanggal' => 'required|date',
            'barang_id' => 'required|exists:m_barang,barang_id',
            'supplier_id' => 'required|exists:m_supplier,supplier_id',
        ]);

        StokModel::create([
            'stok_jumlah' => $request->stok_jumlah,
            'stok_tanggal' => $request->stok_tanggal,
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    public function show(string $id)
    {
        $stok = StokModel::with(['barang', 'supplier'])->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok Barang',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Data Stok Barang'
        ];

        $activeMenu = 'stok';

        return view('stok.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'stok' => $stok,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::all();
        $supplier = SupplierModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Stok'
        ];

        $activeMenu = 'stok';

        return view('stok.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'stok' => $stok,
            'barang' => $barang,
            'supplier' => $supplier,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'stok_jumlah' => 'required|numeric',
            'stok_tanggal' => 'required|date',
            'barang_id' => 'required',
            'supplier_id' => 'required',
        ]);

        StokModel::find($id)->update([
            'stok_jumlah' => $request->stok_jumlah,
            'stok_tanggal' => $request->stok_tanggal,
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = StokModel::find($id);
        if (!$check) {
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            StokModel::destroy($id);
            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena terkait dengan data lain');
        }
    }
}
