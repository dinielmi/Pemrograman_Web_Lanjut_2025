<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        //tambah data
        // $data = [
        // 'username' => 'customer-1',
        // 'nama' => 'Pelanggan',
        // 'password' => Hash::make('12345'),
        // 'level_id' => 4
        // ];

        // //tambah data dengan Eloquent Model
        $data = [
            'nama' => 'Pelanggan Pertama',
        ];

        // UserModel::insert($data);   //tambahkan data ke table m_user
        UserModel::where('username', 'customer-1')->update($data);  //update data user


        // // Ambil semua data dari tabel m_user (sesuai model UserModel)
        $user = UserModel::all();

        // Kirim data ke view user.blade.php
        return view('user', ['data' => $user]);
    }
}


