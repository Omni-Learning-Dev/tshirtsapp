<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;

class PriceController extends Controller
{
    public function index()
    {
        return inertia('Admin/Prices', [
            'prices' => Price::with('category')->get(),
            'categories' => \App\Models\Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'size' => 'required|string',
            'gender' => 'required|string',
            'usd_price' => 'required|numeric',
            'rtgs_price' => 'required|numeric'
        ]);

        if ($request->id) {

            $price = Price::find($request->id);
        } else {
            $price =  new Price();
        }

        $price->category_id = $request->category_id;
        $price->size        = $request->size;
        $price->gender      = $request->gender;
        $price->usd_price   = $request->usd_price;
        $price->rtgs_price  = $request->rtgs_price;
        $price->save();

        return back()->with('message',[
            'type' => 'success',
            'description' => 'Price details added successfully',
        ]);
    }

    public function destroy(Price $price)
    {
        $price->delete();

        return back()->with('message',[
            'type' => 'success',
            'description' => 'Price deleted successfully',
        ]);
    }
}
