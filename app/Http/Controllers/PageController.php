<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('login', 'oauth');
        $this->middleware('auth')->except('login', 'oauth');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function oauth()
    {
        return view('vendor.passport.authorize');
    }
}
