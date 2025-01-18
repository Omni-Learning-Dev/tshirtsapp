<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return inertia('Admin/Products', [
            'categories' => \App\Models\Category::all(),
            'products' => Product::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'size' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable'
        ]);

        if (is_file($request->image_url)) {
            $path = $this->uploadFile($request->image_url, '/storage/products/');
            $validated['image_url'] = $path;
        }
        if ($request->id) {
            $product = Product::find($request->id);
            $product->update($validated);
        } else {
            $product = Product::create($validated);
        }

        return back()->with('message', [
            'type' => 'success',
            'description' => 'Product details added successfully',
        ]);
    }
}
