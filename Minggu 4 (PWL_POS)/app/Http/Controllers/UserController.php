<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function index() {
    //     $user = UserModel::findOrFail(1);
    //     return view('user', ['data'=> $user]);
    // }

    // public function index() {
    //     $user = UserModel::where('username', 'manager9')->firstOrFail();
    //     return view('user', ['data' => $user]);
    // }

    // public function index() {
    //     $user = UserModel::where('level_id', 2)->count();
    //     return view('user', ['data' => $user]);
    // }

    //Praktikum 2.4
    // public function index(){
    //     $user = UserModel::firstOrNew(
    //         [
    //             'username' => 'manager33',
    //             'nama' => 'Manager Tiga Tiga',
    //             'password' => Hash::make('12345'),
    //             'level_id' => 2
    //         ],
    //     );
    //     $user->save();

    //     return view('user', ['data' => $user]);
    // }

    //praktikum 2.5
    public function index()
    {
        $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);

        $user->username = 'manager12';

        $user->save();

        $user->wasChanged(); // true
        $user->wasChanged('username'); // true
        $user->wasChanged(['username', 'level_id']); // true
        $user->wasChanged('nama'); // false
        dd($user->wasChanged(['nama', 'username'])); // true
    }



}

