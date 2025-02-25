<?php       //menandakan bahwa file ini merupakan file php

use App\Http\Controllers\ItemController;            //mendefinisikan penggunaan class ItemController dari namespace App/Http/Controller
use Illuminate\Support\Facades\Route;               //mendefinisikan penggunaan class facades route  yang digunakan untuk mendefinisikan route-nya

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/  //ini command yang menjelaskan penggunaan route web aplikasi

Route::get('/', function () {       //mendefinisikan route http get 
    return view('welcome');         // mengembalikan view atau tampilamn welcome yang merupakan tampilan default yang disediakan oleh laravel
});

Route::resource('items', ItemController::class);    // mendefinisikan route untuk resource item, yang secara otomatis membuat route untuk semua operasi do conteroller crud