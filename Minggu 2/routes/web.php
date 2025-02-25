<?php       //menandakan bahwa file ini merupakan file php

use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ItemController;            //mendefinisikan penggunaan class ItemController dari namespace App/Http/Controller
// use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\WelcomeController;
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

// Route::get('/hello', function(){
//     return 'Hello World';
// });

Route::get('/hello', [WelcomeController::class, 'hello']);

Route::get('/world', function(){
    return 'World';
});

Route::get('/', function(){
    return 'Selamat Datang';
});

Route::get('/about', function(){
    return 'Nama : Dini Elminingtyas  ,  NIM : 2341760180' ;
});

Route::get('/user/{name}', function($name){
    return 'Nama Saya '.$name;
});

Route::get('/posts/{post}/comments/{comment}', function($postId, $commentId){
    return 'Pos ke-' . $postId . "Komentar ke : " . $commentId;
});

Route::get('/articles/{Id}', function($Id){
    return 'Halaman Artikel Dengan ID : ' . $Id;
});

Route::get('/user/{name?}', function ($name=null){
    return 'Nama Saya ' . $name;
});

//Route Name
// Route::get('/user/profile', function(){
//     //
// }) ->name('profile');

// Route::get(
//     '/user/profile',
//     [UserProfileController::class, 'show']
// )->name('profile');

// //Generating URLs...
// $url = route('profile');

// //Generating redirects...
// return redirect() -> route('profile');


//Route Group
// Route::middleware(['first', 'second'])  ->group (function() {
//     Route::get('/', function (){
//         //Uses first& second middleware
//     });
//     Route::get('/user/profile', function(){
//         //Uses first& second middleware
//     });
// });

// Route::domain('{account}.example.com')->group(function(){
//     Route::get('/user/{id}', function ($account, $id){
//         //
//     });
// });

// Route::middleware('auth')->group(function(){
//     Route::get('/user', [UserController::class, 'index']);
//     Route::get('/post', [PostController::class, 'index']);
//     Route::get('/event', [EventController::class, 'index']);
// });


//Route Prefixes
// Route::prefix('admin')->group(function(){
//     Route::get('/user', [UserController::class, 'index']);
//     Route::get('/post', [PostController::class, 'index']);
//     Route::get('/event', [EventController::class, 'index']);
// });


// //Redirect Routes
// Route::redirect('/here', '/there');

// //View Routes
// Route::view('/welcome', 'welcome');
// Route::view('/welcome', 'welcome', ['name' => 'Taylor']);

Route::get('/', [Homecontroller::class, 'index']);
Route::get('/about', [AboutController::class, 'about']);
Route::get('/articles/{id}', [ArticleController::class, 'articles']);

Route::resource('photos', PhotoController::class)-> only([
    'index', 'show'
]);

Route::resource('photos', PhotoController::class)->except([
    'create', 'store', 'update', 'destroy'
]);


//View
// Route::get('/greeting', function (){
//     return view('hello', ['name' => 'Dini']);
// });

// Route::get('/greeting', function (){
//     return view('blog.hello', ['name' => 'Andi']);
// });

Route::get('/greeting', [WelcomeController::class, 'greeting']);

