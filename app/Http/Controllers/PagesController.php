<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function howItWorks()
    {
        return view('pages.how-it-works');
    }

    public function shop()
    {
        return view('pages.shop');
    }
}
