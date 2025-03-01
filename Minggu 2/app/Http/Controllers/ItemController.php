<?php       //menandakan bahwa file ini merupakan file php

namespace App\Http\Controllers;     //mendefinisikan pembuatan space di dalam folder App/Http/Controller

use App\Models\Item;                // mendefinisikan penggunaan class / folder model Item yang merupakan representasi dari table item di database
use Illuminate\Http\Request;        // mendefinisikan penggunaan class request yang digunakan untuk menangani data melalui http
use Illuminate\Routing\Controller;

class ItemController extends Controller     //mendefinisikan pembuatan class ItemController yang merupakan extends atau turunan dari class Controller.
{
    public function index()                 //menandakan pembuatan function index yang digunakan untuk display semua item
    {
        // $items = item::all();               //merepresentyasikan pengambilan semua data dari folder model item dan menyimpannya menggunakan variable items 
        return view('items.index', compact('items'));       //return atau mengembalikan view items.index dan memgirimkan / menampilkan variable items kepada view tersebut
    }

    public function create()            //menandakan pembuatan function create yang digunakan untuk menampilkan form pembuatan item baru yang mana nantinya berisikan name dan description dari item yang mau dibuat
    {
        return view(('items.create'));      // return atau mengembalikan/ menampilkan view items.create yang berisi form pembuatan item baru
    }

    public function store(Request $request)     // menandakan pembuatan function store atau penyimpanan, yang nantinya menyimpan item yang baru dibuat ke dalam database
    {
        $request->validate([            // melakukan validasi dari data yang direquest / sebelumbya dibuat
            'name' => 'required',           //merupakan pengecekan name, jika required atau diisi maka bisa melanjutkan ke langkah berikutnya
            'description' => 'required',    //merupakan pengecekan description, jika required atau terisi maka melanjutkan ke langkah selanjutnya
        ]);

        // Item::create($request->only(['name', 'description']));      //membuat item baru di database sesuai dengan data yang sudah divalidasi sebelumnya
        // return redirect()->route('items.index')->with('success', 'item added successfully.');       // return atau mengembalikan pengguna ke halaman awal(index) dan menampilkan pesan success
    }

    // public function show(Item $item)        //pembuatan function baru yaitu show, untuk menampilkan detail dari item yang ada di database
    // {
    //     return view('items.show', compact('item'));        //return tampilan atau view items.show dan mengirimkan atau menampilkan variable item
    // }

    // public function edit(Item $item)           //pembuatan function edit, yang digunakan untuk emlakukan pengeditan terhadap item yang ada didalam database
    // {
    //     return view('Items.edit', compact('item'));     //return tampilan atau view items.edit dan mengirimkan atau menampilkan variable item 
    // }

    // public function update(Request $request, Item $item)       //pembuatan function update yang digunakan untuk memperbatui item yang ada pada database
    // {
    //     $request->validate([            // melakukan validasi dari data yang direquest oleh user
    //         'name' => 'required',           //merupakan pengecekan name, jika required atau diisi maka bisa melanjutkan ke langkah berikutnya
    //         'description' => 'required',    // merupakan pengecekan description, jika required atau diisi maka bisa melanjutkan ke langkah berikutnya
    //     ]);

    //     $item->update($request->only(['name', 'description']));     //memperbarui item berdasarkan data yang telah divalidasi sebelumnya
    //     return redirect()->route('items.index')->with('success', 'item updated successfully');      //redirect atau mengalihkan penguna ke halaman index dan menampilkan pesan success
    // }

//     public function destroy(Item $item)     // pembuatan function destroy yang digunakan untuk menghapus data item yang ada di dalam database
//     {
//         $item->delete();        //menghapus item dari databse
//         return redirect()->route('items.index')->with('success', 'item deleted successfully');      // redirect tampilan pengguna ke halaman index, dan menampilkan pesan success / deleted successfully
//     }
}       //akhir dari source code
