<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Braintree\Gateway;
use Braintree_Transaction;
use Illuminate\Support\Facades\Auth;

class BraintreeController extends Controller
{
    public function createToken(Request $request)
    {

        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '4j7xxvjbm3nxqjcx',
            'publicKey' => 'tx56955wgpt7q9s8',
            'privateKey' => '558b75f1f99d2616e1f7e639d08fb532',
            'customer_id' => Auth::user()->id
        ]);
        $clientToken = $gateway->clientToken()->generate([]);

        return view('braintree.payment', compact("clientToken"));
    }
    /*

    
    // or like this:
    $config = new Braintree\Configuration([
        'environment' => 'sandbox',
        'merchantId' => '4j7xxvjbm3nxqjcx',
        'publicKey' => 'tx56955wgpt7q9s8',
        'privateKey' => '558b75f1f99d2616e1f7e639d08fb532'
    ]);
    $gateway = new Braintree\Gateway($config)
    
    
    // pass $clientToken to your front-end
    $clientToken = $gateway->clientToken()->generate([
        "customerId" => $aCustomerId
        // Auth::user->id;
    ]);
    
    echo($clientToken = $gateway->clientToken()->generate());
    
    
    // Then, create a transaction:
    $result = $gateway->transaction()->sale([
        'amount' => '10.00',
        'paymentMethodNonce' => $nonceFromTheClient,
        'deviceData' => $deviceDataFromTheClient,
        'options' => [ 'submitForSettlement' => True ]
    ]);
    
    if ($result->success) {
        print_r("success!: " . $result->transaction->id);
    } else if ($result->transaction) {
        print_r("Error processing transaction:");
        print_r("\n  code: " . $result->transaction->processorResponseCode);
        print_r("\n  text: " . $result->transaction->processorResponseText);
    } else {
        foreach($result->errors->deepAll() AS $error) {
            print_r($error->code . ": " . $error->message . "\n");
        }
    }

    */
}