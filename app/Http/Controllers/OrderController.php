<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\inertia;

class OrderController extends Controller
{
    public function index(){
        return Inertia::render('Admin/CreateOrder');
           
    }

    public function create(){

    }

    public function store(Request $request){
       $request->validate([
        'quantity' =>"required",
        'logo_image'=>'required',
        'front_text'=>'required',
        'back_text'=>'required',
        'total_price'=>'required',
        'status'=>'required',
        'payment_status'=>'required',
        'gender'=>'required',
        'size'=>'required',
       ]);
       
       $order = new Order();

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

       return back()->with('message',[
        'title'         =>"successfully added",
        'description'   =>'Details added successfully',
       'type'           =>'success'
       ]);

    }

    public function update(Request $request, Order $order)
    {


        $request->validate([
            'quantity' =>"required",
            'logo_image'=>'required',
            'front_text'=>'required',
            'back_text'=>'required',
            'total_price'=>'required',
            'status'=>'required',
            'payment_status'=>'required',
            'gender'=>'required',
            'size'=>'required',
            
        ]);

        $order->quantity                =$request->quantity;
        $order->logo_image              =$request->logo_image;
        $order->front_text              =$request->front_text;
        $order->back_text               =$request->back_text;
        $order->total_price             =$request->total_price;
        $order->status                  =$request->status;
        $order->payment_status          = $request->payment_status;
        $order->gender                  = $request->gender;
        $order->size                    = $request->size;

        $order->save();

        return back()->with('message',[
            'title'       => 'Successfully',
            'description' => 'order updated successfully',
            'type'        => 'success'
        ]);
    }

    public function destroy($id)
    {

        Order::find($id)->delete();

        return back()->with('message',[
            'title'       => 'Successfully',
            'description' => 'Order Deleted',
            'type'        => 'success'
        ]);
    }

}
