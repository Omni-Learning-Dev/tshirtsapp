<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;

class PagesController extends Controller
{
    public function welcome()
    {
        $categories = Category::orderBy('name','DESC')->get();
        return Inertia::render('Welcome',[
            'categories' => $categories,
        ]);
    }


    public function contact()
    {
        return Inertia::render('Admin/contact');
    }
}
