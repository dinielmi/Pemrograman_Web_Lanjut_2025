<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Fungsi untuk menampilkan semua produk
    public function index()
    {
        $products = Product::all(); // Mengambil semua data produk
        return view('products.index', compact('products'));
    }

    // Fungsi untuk menampilkan form tambah produk
    public function create()
    {
        return view('products.create');
    }

    // Fungsi untuk menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Menyimpan data produk baru
        Product::create($request->all());

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Fungsi untuk menampilkan detail produk
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Fungsi untuk menampilkan form edit produk
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Fungsi untuk mengupdate data produk
    public function update(Request $request, Product $product)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Update data produk
        $product->update($request->all());

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Fungsi untuk menghapus produk
    public function destroy(Product $product)
    {
        $product->delete();

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }

}
