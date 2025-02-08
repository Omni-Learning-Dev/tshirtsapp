<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Emmanuelsiziba\Payments\Pesepay;


class PesepayController extends Controller
{
    public function initiatePayment(Request $request){
        $pesepay = new Pesepay(
            config('services.pesepay.int_key'),
            config('services.pesepay.ency_key'),
        );

        $pesepay->returnUrl =  route('pese-return');
        $pesepay->resultUrl =  route('pese-result',now());

        $requiredFields = ['customerPhoneNumber'=> $request->customerPhoneNumber];

        $payment = $pesepay->createPayment(
            'USD',
            'PZW211',
            $request->customerPhoneNumber.'@capital-creative.com',
            $request->reason,
            $request->reason,
        );


        $response = $pesepay->makeSeamlessPayment(
            $payment,
            $request->reason,
            $request->amount,
            $requiredFields,
            $request->reason,
        );

        if ($response->success()) {
            # Save the reference number and/or poll url (used to check the status of a transaction)
            $referenceNumber  = $response->referenceNumber();
            $pollUrl          = $response->pollUrl();

            $paymentSaved = new Payment();

            $order = Order::find($request->order_id);

             $paymentSaved->order_id        = $request->order_id;
             $paymentSaved->client_id       = $request->client_id;
             $paymentSaved->amount          = $request->amount;
             $paymentSaved->status          = 'pending';
             $paymentSaved->currency        = 'USD';
             $paymentSaved->payment_method  = 'Express';
             $paymentSaved->transaction_id  = $referenceNumber;
             $paymentSaved->notes           = $request->reason;
            $paymentSaved->save();

            return response()->json([
                'ref_num'      => $referenceNumber,
                'pollUrl'      => $pollUrl,
                'status'       => 'success',
                'message'      => 'Please enter pin on your phone'
            ]);


        } else {
            #Get Error Message
            $errorMessage = $response->message();

            return response()->json([
                'status'       => 500,
                'message'      => $errorMessage
            ]);
        }

    }


    public function pesePayResult($id){

        $payment = Payment::where('transaction_id',$id)->first();

        return inertia('PaymentSuccess',[
            'order' =>  Order::find( $payment->order_id),
            'payment' =>  $payment,
            'referenceNumber'=>$id,
        ]);
    }


    public function pesePayReturn(Request $request){
        $pesepay = new Pesepay(
            config('services.pesepay.int_key'),
            config('services.pesepay.ency_key'),
        );
        $response = $pesepay->checkPayment($request->ref_num);

        if ($response->success()) {

            if ($response->paid()) {

                $paymen = Payment::where('transaction_id',$request->ref_num)->first();
                $paymen->status = 'successful';
                $paymen->save();

                $order = Order::find($paymen->order_id);
                $order->payment_status = 'paid';
                $order->save();

                return response()->json([
                    'status'       => 'paid',
                    'ref_num'      => $request->ref_num,
                    'message'      => 'Payment Complete'
                ]);

            }else{

                return response()->json([
                    'status'      => 'processing',
                    'ref_num'      => $request->ref_num,
                    'message'     =>  'pending please wait'
                ]);
            }

        } else {
            # Get error message
            return response()->json([
                'status'      => 'failed',
                'message'     =>  $response->message()
            ]);
        }
    }
}
