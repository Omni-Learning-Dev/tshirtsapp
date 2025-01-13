<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

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
            'slug'=>'required',
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

        $category->name                     = $request->name;
        $category->slug                     = $request->slug;
        $category->preview_image            = $request->preview_image;
        $category->description              = $request->description;
        $category->gender                   = $request->gender;
        $category->sizes                    = $request->sizes;

        $category->save();

        return back()->with('message',[
            'type' => 'success',
            'description' => 'Category detaiils added successfully',
        ]);


        }
        
        public function show(Category $category){

        }
        
        public function edit($id){
            $category = Category::findOrfail($id);
            return Inertia::render('CategoryEdit',[
                'category' => $category,
            ]);
        
        }
        
        public function destroy($id){
            $category =Category::find($id);
            $category->delete();
            
            return back()->with('message',[
                'type' =>'success',
                'title' =>'student Deleted'
            ]);
        }
    
    }
