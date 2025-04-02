<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomepageController::class, 'index']);

Route::prefix('product')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/category/food-beverage', [ProductController::class, 'foodBeverage'])->name('product.food-beverage');
    Route::get('/category/beauty-health', [ProductController::class, 'beautyHealth'])->name('product.beauty-health');
    Route::get('/category/home-care', [ProductController::class, 'homeCare'])->name('product.home-care');
    Route::get('/category/baby-kid', [ProductController::class, 'babyKids'])->name('product.baby-kid');
});

Route::get('/user/{id}/name/{name}', [UserController::class, 'show']);

Route::get('/sales', function(){
    return view('transaction');
});



Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);

// //praktikum 2.6
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);         // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);    // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);        // menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']);        // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);    // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);      // menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']);  // menghapus data user
    Route::post('/data', [UserController::class, 'getUsers'])->name('user.data');
});