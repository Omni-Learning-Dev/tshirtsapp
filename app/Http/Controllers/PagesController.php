<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    public function welcome()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return Inertia::render('Welcome', [
            'categories' => $categories,
        ]);
    }

    public function order($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return Inertia::render('MakeOrder', [
            'category' => $category,
        ]);
    }

    public function sendOrder(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'quantity'     => 'required|integer|min:1',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'front_text' => 'nullable|string|max:255',
            'back_text' => 'nullable|string|max:255',
            'category_id' => 'nullable',
            'size' => 'required', // Ensure 'size' is an array
            'gender' => 'required', // Ensure 'gender' is an array
        ]);

        // Handle the uploaded logo image
        if ($request->hasFile('logo_image')) {
            $path =  $this->uploadFile($request->logo_image, '/storage/orders/logos/');
        } else {

            $path = $request->logo_image;
        }

        // dd($request->all());

        $order = new Order();
        $order->client_id   = 1;
        $order->total_price = 100;
        $order->category_id = $request->category_id;
        $order->quantity    = $request->quantity;
        $order->size        = $request->size;
        $order->logo_image  = $path;
        $order->front_text  = $request->front_text;
        $order->back_text   = $request->back_text;
        $order->gender      = $request->gender;
        $order->notes       = $request->notes;

        $order->save();

        // Send email notification
        Mail::to('emmanuel@omni-learning.com')->send(new \App\Mail\OrderPlaced($order));

        return back()->with('message', [
            'type' => 'success',
            'description' => 'Category details added successfully',
        ]);
    }


    public function contact()
    {
        return Inertia::render('Admin/contact');
    }
}
