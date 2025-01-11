<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PagesController extends Controller
{
    public function welcome()
    {
        return Inertia::render('Welcome');
    }


    public function contact()
    {
        return Inertia::render('Admin/contact');
    }
}
