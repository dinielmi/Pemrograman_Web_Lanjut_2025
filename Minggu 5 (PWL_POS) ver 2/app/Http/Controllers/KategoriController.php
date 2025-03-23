<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori dalam sistem'
        ];

        $activeMenu = 'kategori';

        $kategori = KategoriModel::all();

        return view('kategori.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }


    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodeKategori' => 'required|string|max:10|unique:m_kategori,kategori_kode',
            'namaKategori' => 'required|string|max:255',
        ]);

        KategoriModel::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = KategoriModel::findOrFail($id);
        return view('kategori.edit', ['kategori' => $data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kodeKategori' => 'required|string|max:10|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'namaKategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriModel::findOrFail($id);
        $kategori->update([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriModel::findOrFail($id);
        $kategori->delete();

        return redirect('/kategori')->with('success', 'Kategori berhasil dihapus.');
    }

    public function getData()
    {
        $kategori = KategoriModel::select(['kategori_id', 'kategori_kode', 'kategori_nama']);

        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '<a href="' . route('kategori.edit', $row->kategori_id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . route('kategori.delete', $row->kategori_id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
