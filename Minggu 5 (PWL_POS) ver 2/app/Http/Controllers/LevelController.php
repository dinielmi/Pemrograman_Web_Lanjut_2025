<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
     public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level pengguna dalam sistem'
        ];

        $activeMenu = 'level';
        
        $levels = LevelModel::all();
        
        return view('level.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'levels' => $levels,
            'activeMenu' => $activeMenu
        ]);
    }

    public function showLevel()
    {
        $levels = LevelModel::all();
        return view('m_level', compact('levels'));
    }

    public function create()
    {
        return view('level.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_nama' => 'required|string|max:255',
        ]);

        LevelModel::create([
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Level berhasil ditambahkan');
    }

    public function edit($id)
    {
        $level = LevelModel::findOrFail($id);
        return view('level.edit', compact('level'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'level_nama' => 'required|string|max:255',
        ]);

        $level = LevelModel::findOrFail($id);
        $level->update([
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Level berhasil diperbarui');
    }

    public function destroy($id)
    {
        LevelModel::destroy($id);
        return redirect('/level')->with('success', 'Level berhasil dihapus');
    }

    public function getLevels(Request $request)
    {
        if ($request->ajax()) {
            $levels = LevelModel::with('users')->select('id', 'level_nama');

            return DataTables::of($levels)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    return '<button class="btn btn-sm btn-primary edit-btn" data-id="'.$row->id.'">Edit</button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="'.$row->id.'">Hapus</button>';
                })
                ->rawColumns(['aksi']) // Pastikan kolom "aksi" bisa ditampilkan sebagai HTML
                ->make(true);
        }
    }

    
}

