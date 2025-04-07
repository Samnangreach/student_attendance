<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home'); // Blade view for home page
    }

    public function about()
    {
        return view('pages.about'); // Blade view for about page
    }

    public function privacy()
    {
        return view('pages.privacy'); // Blade view for hotel page
    }

    public function contact()
    {
        return view('pages.contact'); // Blade view for contact page
    }

    public function Login()
    {
        return view('auths.login'); // Blade view for login page
    }
}
