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

    public function order($slug)
    {
        $category = Category::where('slug',$slug)->first();
        return Inertia::render('MakeOrder',[
            'category' => $category,
        ]);
    }


    public function contact()
    {
        return Inertia::render('Admin/contact');
    }
}
