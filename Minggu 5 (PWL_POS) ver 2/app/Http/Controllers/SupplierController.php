<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Suppliers']
        ];

        $page = (object) [
            'title' => 'Daftar supplier dalam sistem'
        ];

        $activeMenu = 'suppliers';

        $suppliers = Supplier::all();

        return view('suppliers.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'suppliers' => $suppliers,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:15',
        ]);

        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect('/suppliers')->with('success', 'Supplier berhasil ditambahkan');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:15',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect('/suppliers')->with('success', 'Supplier berhasil diperbarui');
    }

    public function destroy($id)
    {
        Supplier::destroy($id);
        return redirect('/suppliers')->with('success', 'Supplier berhasil dihapus');
    }

    public function getSuppliers(Request $request)
    {
        if ($request->ajax()) {
            $suppliers = Supplier::select('id', 'nama_supplier', 'alamat', 'telepon');

            return DataTables::of($suppliers)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    return '<a href="'.url('suppliers/edit', $row->id).'" class="btn btn-sm btn-warning">Edit</a>
                            <form action="'.url('suppliers/destroy', $row->id).'" method="POST" style="display:inline;">
                                '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</button>
                            </form>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }
}
