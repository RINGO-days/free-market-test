<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{
    
    
    public function email() //後で消す
    {
        return view('auth.email');
    }

    public function profile()
    {
        return view('auth.profile');
    }
}
