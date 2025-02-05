<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\Price;
use App\Models\Quantity;
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
            'clients'  => Client::all(),
            'tab'      => 'one'
        ]);
    }

    public function orderInitiated($order){
        $order = Order::find($order)->with(['category'])->first();

        return inertia('OrderInitiated',[
            'order' => $order,
            'category' => $order->category,
            'tab'      => 'two'
        ]);
    }

    public function sendOrder(Request $request){

        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'front_text' => 'nullable|string|max:255',
            'back_text' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'payment_status' => 'nullable|in:paid,unpaid',
            'status' => 'nullable|in:initiated,pending,completed,canceled',
        ]);

        // Handle logo image upload using your custom function
        if ($request->hasFile('logo_image')) {
            $logoImagePath = $this->uploadFile($request->file('logo_image'), 'uploads/logos/');
            $validatedData['logo_image'] = $logoImagePath;
        }

        $order = Order::create([
            'category_id'    => $validatedData['category_id'],
            'logo_image'     => $validatedData['logo_image'] ?? null,
            'front_text'     => $validatedData['front_text'] ?? null,
            'back_text'      => $validatedData['back_text'] ?? null,
            'notes'          => $validatedData['notes'] ?? null,
            'payment_status' => $validatedData['payment_status'] ?? 'unpaid',
            'status'         => $validatedData['status'] ?? 'initiated',
        ]);

        // Redirect to the order initiated route with a success message
        return redirect()->route('orderInitiated', $order->id)->with('message', [
            'type' => 'success',
            'description' => 'Order initiated successfully!',
        ]);
    }

    public function sendOrderQuantities(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'sizes' => 'required|array|min:1',
            'sizes.*.size' => 'required|string',
            'sizes.*.quantity' => 'required|integer|min:1',
            'sizes.*.gender' => 'nullable|string',
        ],[
            'sizes.*.size' =>'This size field is required',
            'sizes.*.quantity' =>'This quantity field is required',
            'sizes.*.gender' =>'This gender field is required',
        ]);

        foreach ($request->sizes as $sizeData) {
            Quantity::create([
                'order_id' => $request->order_id,
                'size' => $sizeData['size'],
                'quantity' => $sizeData['quantity'],
                'gender' => $sizeData['gender'] ?? null,
            ]);
        }


        // Redirect to the order initiated route with a success message
        return redirect()->route('orderAddClient', $request->order_id)->with('message', [
            'type' => 'success',
            'description' => 'Order initiated successfully!',
        ]);
    }

    public function addClientToOrder(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'company_name' => 'nullable|string|max:255',
        ]);
        $client = Client::where('phone', $validatedData['phone'])->first();
        if (!$client) {
            // Create a new client if they don't exist
            $client = Client::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
                'gender' => $validatedData['gender'],
                'company_name' => $validatedData['company_name'],
            ]);
        }

        $order = Order::find($validatedData['order_id']);
        $order->client_id = $client->id;
        $order->save();

        return redirect()->route('payorder', $request->order_id)->with('message', [
            'type' => 'success',
            'description' => 'Client added to order!',
        ]);
    }

    public function payorder($id)
    {
        $order = Order::find($id)->with(['category','quantities'])->first();

        return inertia('PayOrder',[
            'order'    => $order,
            'prices'   => Price::where('category_id',$order->category->id)->get(),
            'category' => $order->category,
            'tab'      => 'three'
        ]);
    }

    public function orderAddClient($order)
    {
        $order = Order::find($order)->with(['category','quantities'])->first();

        return inertia('orderAddClient',[
            'order' => $order,
            'prices' => Price::where('category_id',$order->category->id)->get(),
            'category' => $order->category,
            'tab'      => 'three'
        ]);
    }

    public function removeSize(Order $order, $index)
    {

        Quantity::find($index)->delete();

        return redirect()->back()->with('message', [
            'type' => 'success',
            'description' => 'Size removed successfully!',
        ]);
    }

    public function contact()
    {
        return Inertia::render('Admin/contact');
    }
}
