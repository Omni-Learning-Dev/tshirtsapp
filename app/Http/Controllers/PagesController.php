<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Client;
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
        $category = Category::where('slug', $slug)->with('prices')->first();
        return Inertia::render('MakeOrder', [
            'category' => $category,
            'clients'  => Client::all()
        ]);
    }

  public function sendOrder(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|unique:clients,phone',
        'email' => 'nullable|email',
        'address' => 'nullable|string',
        'gender' => 'nullable|in:male,female,other',
        'date_of_birth' => 'nullable|date',
        'company_name' => 'nullable|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'logo_image' => 'nullable|image',
        'front_text' => 'nullable|string',
        'back_text' => 'nullable|string',
        'notes' => 'nullable|string',
        'sizes' => 'required|array',
        'sizes.*.size' => 'required|string',
        'sizes.*.quantity' => 'required|integer|min:1',
        'sizes.*.gender' => 'nullable|string',
    ]);

    // Step 1: Save or fetch the client
    $client = \App\Models\Client::firstOrCreate(
        ['phone' => $validatedData['phone']],
        [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'] ?? null,
            'address' => $validatedData['address'] ?? null,
            'gender' => $validatedData['gender'] ?? null,
            'date_of_birth' => $validatedData['date_of_birth'] ?? null,
            'company_name' => $validatedData['company_name'] ?? null,
        ]
    );

    // Step 2: Save the order
    $orderData = [
        'client_id' => $client->id,
        'category_id' => $validatedData['category_id'],
        'logo_image' => $request->file('logo_image') 
            ? $request->file('logo_image')->store('logos', 'public') 
            : null,
        'front_text' => $validatedData['front_text'] ?? null,
        'back_text' => $validatedData['back_text'] ?? null,
        'notes' => $validatedData['notes'] ?? null,
        'status' => 'pending',
        'payment_status' => 'unpaid',
    ];

    $order = \App\Models\Order::create($orderData);

    // Step 3: Add quantities to the order
    foreach ($validatedData['sizes'] as $size) {
        \App\Models\Quantity::create([
            'order_id' => $order->id,
            'size' => $size['size'],
            'quantity' => $size['quantity'],
            'gender' => $size['gender'] ?? null,
        ]);
    }

    // Step 4: Send email notification
    Mail::to('emmanuel@omni-learning.com')->send(new \App\Mail\OrderPlaced($order));

    // Return success response
    return back()->with('message', [
        'type' => 'success',
        'description' => 'Order placed successfully!',
    ]);
}



    public function contact()
    {
        return Inertia::render('Admin/contact');
    }
}
