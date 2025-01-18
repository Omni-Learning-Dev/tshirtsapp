<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return Inertia('Admin/Categories',[
            'categories' => $categories
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'preview_image'=>'required',
            'description'=>'required',
            'gender'=>'required',
            'sizes'=>'required',
        ]);

        // checking if the id is already exist

        if($request->id){
            $category =Category::find($request->id);
        }else{
            $category = new Category;
        }


        if(is_file($request->preview_image)){
            $path = $this->uploadFile($request->preview_image,'/storage/categories/');
        }else{
            $path = $request->preview_image;
        }

        $category->name                     = $request->name;
        $category->slug                     = Str::slug($request->name);
        $category->preview_image            = $path;
        $category->description              = $request->description;
        $category->gender                   = $request->gender;
        $category->sizes                    = $request->sizes;

        $category->save();

        return back()->with('message',[
            'type' => 'success',
            'description' => 'Category details added successfully',
        ]);


        }


        public function edit($id){
            $category = Category::findOrfail($id);
            return Inertia::render('CategoryEdit',[
                'category' => $category,
            ]);

        }

        public function destroy($id){
            $category = Category::find($id);
            $category->delete();

            return back()->with('message',[
                'type' =>'success',
                'title' =>'categgory Deleted'
            ]);
        }



    }
