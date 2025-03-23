<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);

//praktikum 2.6
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);         // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);    // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);        // menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']);        // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);    // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);      // menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']);  // menghapus data user
});


Route::prefix('level')->group(function() {
    Route::get('/', [LevelController::class, 'index']);
    Route::get('/create', [LevelController::class, 'create']);
    Route::post('/', [LevelController::class, 'store']);
    Route::get('/{id}/edit', [LevelController::class, 'edit']);
    Route::put('/{id}', [LevelController::class, 'update']);
    Route::delete('/{id}', [LevelController::class, 'destroy']);
    Route::post('/levels/data', [LevelController::class, 'getLevels'])->name('levels.data');
});

Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index']);
    Route::get('/list', [KategoriController::class, 'getData']);
    Route::get('/create', [KategoriController::class, 'create']);
    Route::post('/store', [KategoriController::class, 'store']);
    Route::get('/edit/{id}', [KategoriController::class, 'edit']);
    Route::post('/update/{id}', [KategoriController::class, 'update']);
    Route::delete('/delete/{id}', [KategoriController::class, 'delete']);
});


Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class, 'index']);
    Route::get('/data', [BarangController::class, 'getData'])->name('barang.data'); 
    Route::get('/create', [BarangController::class, 'create']);
    Route::post('/store', [BarangController::class, 'store']);
    Route::get('/edit/{barang}', [BarangController::class, 'edit']);
    Route::put('/update/{barang}', [BarangController::class, 'update']);
    Route::delete('/delete/{barang}', [BarangController::class, 'destroy']);
});


Route::prefix('suppliers')->group(function () {
    Route::get('/', [SupplierController::class, 'index']);
    Route::get('/create', [SupplierController::class, 'create']);
    Route::post('/store', [SupplierController::class, 'store']);
    Route::get('/edit/{id}', [SupplierController::class, 'edit']);
    Route::put('/update/{id}', [SupplierController::class, 'update']);
    Route::delete('/destroy/{id}', [SupplierController::class, 'destroy']);
});

    