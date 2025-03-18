<?php

use App\Http\Controllers\HomepageController; // Import HomepageController
use App\Http\Controllers\ProductController;  // Import ProductController
use App\Http\Controllers\UserController;     // Import UserController
use Illuminate\Support\Facades\Route;        // Import Route dari Laravel

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| File ini digunakan untuk mendefinisikan semua routing dalam aplikasi POS.
| Setiap route akan menghubungkan URL dengan fungsi atau controller tertentu.
|
*/

// Route untuk halaman utama (Homepage)
Route::get('/', [HomepageController::class, 'index']); 
// Saat mengakses "/", akan memanggil method `index` di HomepageController

// Group route untuk produk (Prefix "product" akan ditambahkan ke semua URL di dalamnya)
Route::prefix('product')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('product.index'); 
    // Akses "/product" → Menampilkan daftar produk (ProductController@index)

    Route::get('/category/food-beverage', [ProductController::class, 'foodBeverage'])->name('product.food-beverage'); 
    // Akses "/product/category/food-beverage" → Menampilkan produk kategori makanan & minuman

    Route::get('/category/beauty-health', [ProductController::class, 'beautyHealth'])->name('product.beauty-health'); 
    // Akses "/product/category/beauty-health" → Menampilkan produk kategori kecantikan & kesehatan

    Route::get('/category/home-care', [ProductController::class, 'homeCare'])->name('product.home-care'); 
    // Akses "/product/category/home-care" → Menampilkan produk kategori perawatan rumah

    Route::get('/category/baby-kid', [ProductController::class, 'babyKids'])->name('product.baby-kid'); 
    // Akses "/product/category/baby-kid" → Menampilkan produk kategori bayi & anak-anak
});

// Route dengan parameter (Menampilkan user berdasarkan ID dan Nama)
Route::get('/user/{id}/name/{name}', [UserController::class, 'show']); 
// Contoh URL: "/user/1/name/Alex" → Akan memanggil method `show` di UserController dengan ID=1 & name="Alex"

// Route untuk halaman transaksi (Langsung menampilkan view tanpa controller)
Route::get('/sales', function(){
    return view('transaction'); // Mengembalikan tampilan "resources/views/transaction.blade.php"
});

