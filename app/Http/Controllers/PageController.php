<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('login');
        $this->middleware('auth')->except('login');
    }

    public function login()
    {
        return view('auth.login');
    }
}
