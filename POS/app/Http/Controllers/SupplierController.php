<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierModel;


class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = SupplierModel::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        SupplierModel::create($request->all());
        return redirect()->route('suppliers.index');
    }

    public function edit($id)
    {
        $supplier = SupplierModel::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = SupplierModel::findOrFail($id);
        $supplier->update($request->all());
        return redirect()->route('suppliers.index');
    }

    public function destroy($id)
    {
        SupplierModel::destroy($id);
        return redirect()->route('suppliers.index');
    }
}
