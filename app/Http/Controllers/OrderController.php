<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\inertia;

class OrderController extends Controller
{
    public function index()
    {

        return Inertia('Admin/Orders/AllOrders', [
            'orders' => Order::all()
        ]);
    }

    public function create() {}

    public function store(Request $request)
    {
        $request->validate([
            'quantity' => "required",
            'logo_image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'front_text' => 'required',
            'back_text' => 'required',
            'total_price' => 'required',
            'status' => 'required',
            'payment_status' => 'required',
            'gender' => 'required',
            'size' => 'required',
        ]);
        $order = new Order();

        $order->quantity         = $request->input('quantity');
        $order->logo_image       = $request->input('logo_image');
        $order->quantity         = $request->input('quantity');
        $order->front_text       = $request->input('front_text');
        $order->back_text        = $request->input('back_text');
        $order->total_price      = $request->input('total_price');
        $order->status           = $request->input('status');
        $order->payment_status   = $request->input('payment_status');
        $order->gender           = $request->input('gender');
        $order->size             = $request->input('size');

        if ($request->hasFile('logo_image')) {
            $filePath = $request->file('logo_image')->store('logos', 'public');
            $order->logo_image = $filePath; // Store the path to the logo image
        }

        $order->save();

        return back()->with('message', [
            'title'         => "successfully added",
            'description'   => 'Details added successfully',
            'type'           => 'success'
        ]);
    }

    public function update(Request $request, Order $order)
    {


        $request->validate([
            'quantity' => "required",
            'logo_image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $order->quantity         = $request->quantity;
        $order->logo_image       = $request->logo_image;
        $order->quantity         = $request->quantity;
        $order->front_text       = $request->front_text;
        $order->back_text        = $request->back_text;
        $order->total_price      = $request->total_price;
        $order->status           = $request->status;
        $order->payment_status   = $request->payment_status;
        $order->gender           = $request->gender;
        $order->size             = $request->size;

        $order->save();

        return back()->with('message', [
            'title'       => 'Successfully',
            'description' => 'order updated successfully',
            'type'        => 'success'
        ]);
    }

    public function destroy($id)
    {

        Order::find($id)->delete();

        return back()->with('message', [
            'title'       => 'Successfully',
            'description' => 'Order Deleted',
            'type'        => 'success'
        ]);
    }
}
