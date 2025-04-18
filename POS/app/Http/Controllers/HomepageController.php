<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Welcome to the Web Page',
            'list' => ['Home', 'Welcome']
        ];
        
        $activeMenu = 'dashboard';
        
        return view('welcome', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}


