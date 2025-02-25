<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return 'Selamat Datang';
    }

    public function about(){
        return 'Nama : Dini Elminingtyas || NIM : 2341760180';
    }

    public function articles($Id){
        return 'Halaman artikel dengan ID : ' . $Id ;
    }
}


