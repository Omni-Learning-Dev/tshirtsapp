<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EmmanuelSiziba\Payments\Pesepay;


class PesepayController extends Controller
{
    public function processPayment(){
        require_once 'path/to/vendor/autoload.php';

        // creating pesepay with intergration key and encryption key

        $pesepay = new Pesepay("INTEGRATION KEY", "ENCRYPTION KEY");
        $pesepay->returnUrl = "http://example.com/gateway/return";
        $pesepay->resultUrl = "http://example.com/gateway/return";

        // create payment object

        $payment = $pesepay->createPayment('CURRECNCY_CODE', 'PAYMENT_METHOD_CODE', 'CUSTOMER_EMAIL(OPTIONAL)', 'CUSTOMER_PHONE_NUMBER(OPTIONAL)', 'CUSTOMER_NAME(OPTIONAL)');
        $requiredFields = ['requiredFieldName'=>'requiredFieldValue'];
        
        //process payment 

        $response = $pesepay->makeSeamlessPayment($payment, 'Online Transaction', $AMOUNT, $requiredFields, 'MERCHANT_REFERENCE(OPTIONAL)');
        
        if ($response->success()) {
            // save the reference number and or poll url (used to check the status of a transaction)

            $referenceNumber = $response->referenceNumber();
            
            $pollUrl = $response->pollUrl();
        } else {
            // Get error Message
            
            $errorMessage = $response->message();
        
        }






    }
}
