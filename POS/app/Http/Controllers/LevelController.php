<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level';

        return view('level.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // public function list(Request $request)
    // {
    //     $levels = LevelModel::select('level_id', 'level_kode', 'level_nama'); // Ubah di sini

    //     return DataTables::of($levels)
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function ($level) {
    //             $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
    //             $btn .= '<form class="d-inline-block" method="POST" action="' .
    //                 url('/level/' . $level->level_id) . '">'
    //                 . csrf_field() . method_field('DELETE') .
    //                 '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi'])
    //         ->make(true);
    // }

    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');
        
        return DataTables::of($levels)
            ->addIndexColumn()
            ->addColumn('aksi', function($row) {
                return '
                    <a href="' . url("level/$row->level_id") . '" class="btn btn-info btn-sm mr-1">Detail</a>
                    <button onclick="modalAction(\'' . url("level/$row->level_id/show_ajax") . '\')" class="btn btn-outline-info btn-sm mr-1" title="Detail">
                        <i class="fa fa-eye"></i>
                    </button>
            
                    <a href="' . url("level/$row->level_id/edit") . '" class="btn btn-warning btn-sm mr-1">Edit</a>
                    <button onclick="modalAction(\'' . url("level/$row->level_id/edit_ajax") . '\')" class="btn btn-outline-warning btn-sm mr-1" title="Edit">
                        <i class="fa fa-edit"></i>
                    </button>
            
                    <form method="POST" action="' . url("level/$row->level_id") . '" style="display:inline;" onsubmit="return confirm(\'Yakin hapus data?\')">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <button onclick="modalAction(\'' . url("level/$row->level_id/delete_ajax") . '\')" class="btn btn-outline-danger btn-sm mt-1" title="Delete">
                        <i class="fa fa-trash"></i>
                    </button>';
            })
            
            ->rawColumns(['aksi'])
            ->make(true);
    }



    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah level baru'
        ];

        $activeMenu = 'level';

        return view('level.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100', // Ubah di sini
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama, // Ubah di sini
        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    public function show(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list'  => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail level'
        ];

        $activeMenu = 'level';

        return view('level.show', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list'  => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit level'
        ];

        $activeMenu = 'level';

        return view('level.edit', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode,' . $id . ',level_id',
            'level_nama' => 'required|string|max:100', // Ubah di sini
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama, // Ubah di sini
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = LevelModel::find($id);
        if (!$check) { 
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            LevelModel::destroy($id);

            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax()
    {
        return view('level.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'level_kode' => 'required|string|max:5|unique:m_level,level_kode',
                'level_nama' => 'required|string|max:100', // Perbaiki di sini
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
            }
    
            LevelModel::create([
                'level_kode' => $request->level_kode,
                'level_nama' => $request->level_nama, // Perbaiki di sini
            ]);
    
            return response()->json(['status' => true, 'message' => 'Data level berhasil disimpan']);
        }
        return redirect('/');
    }
}
