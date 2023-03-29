<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Braintree_Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BraintreeController extends Controller
{
    public function paymentForm(Request $request, Apartment $apartment, Sponsorship $sponsorship)
    {
        return view('braintree.paymentForm', ['apartment' => $apartment, 'sponsorship' => $sponsorship]);
    }


    public function getToken(Request $request)
    {
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '4j7xxvjbm3nxqjcx',
            'publicKey' => 'tx56955wgpt7q9s8',
            'privateKey' => '558b75f1f99d2616e1f7e639d08fb532',
        ]);

        $result = $gateway->customer()->create([
            'firstName' => Auth::user()->name,
            'lastName' => Auth::user()->surname,
            'email' => Auth::user()->email,
            'website' => 'http://boolean.com'
        ]);

        $clientTokenFromServer = $gateway->clientToken()->generate([]);

        return response()->json([
            'success' => true,
            'results' => $clientTokenFromServer
        ]);
    }

    public function sponsorshipIndex(Apartment $apartment)
    {
        $sponsorships = Sponsorship::all();
        return view('braintree.sponsorshipIndex', ['apartment' => $apartment, 'sponsorships' => $sponsorships]);
    }

    public function checkout(Request $request, Sponsorship $sponsorship, Apartment $apartment)
    {

        // $result = $gateway->transaction()->sale([
        //     'amount' => '10.00',
        //     'paymentMethodNonce' => $nonceFromTheClient,
        //     'deviceData' => $deviceDataFromTheClient,
        //     'options' => [
        //         'submitForSettlement' => True
        //     ]
        // ]);

        if (
            $apartment->sponsorships()->where('apartment_id', $apartment->id)->exists()
            && DB::table('apartment_sponsorship')->where('apartment_id', $apartment->id)->orderBy('id', 'desc')->limit(1)->get()[0]->ending_time > now()
        ) {
            $valueToUpdate = DB::table('apartment_sponsorship')
                ->where('apartment_id', $apartment->id)
                ->orderBy('id', 'desc')
                ->limit(1)
                ->get()[0]
                ->ending_time;
            $newEndingDateTime = Carbon::parse($valueToUpdate)->addHours($sponsorship->duration_hours);

            DB::table('apartment_sponsorship')
                ->where('apartment_id', $apartment->id)
                ->where('ending_time', '=', $valueToUpdate)
                ->update(['ending_time' => $newEndingDateTime, 'sponsorship_id' => $sponsorship->id, 'updated_at' => now()]);
        } else {
            $sponsorship->apartments()
                ->attach(
                    $apartment,
                    [
                        'apartment_id' => $apartment->id,
                        'sponsorship_id' => $sponsorship->id,
                        'starting_time' => now(),
                        'ending_time' => now()->addHours($sponsorship->duration_hours),
                        'created_at' => now(),
                    ]
                );
        }
        return view('braintree.checkoutSuccess');
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