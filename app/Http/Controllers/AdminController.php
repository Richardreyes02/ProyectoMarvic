<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function homeAdmin()
    {
        $user = auth()->user();
        return view('Admin.home.home', compact('user'));
    }
}
