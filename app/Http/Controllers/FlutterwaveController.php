<?php

namespace App\Http\Controllers;
use Rave;


class FlutterwaveController extends Controller
{


    public function index()
    {
      return view('payment.index');
    }
    /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize()
    {

           Rave:
            $charge = Rave::initializePayment([
            'amount' => 1000, // Amount in XAF
            'email' => 'user@example.com',
            'tx_ref' => 'MC-01928403', // Unique transaction reference
            'currency' => 'XAF',
            'redirect_url'=> 'https://passioadminpanel.prophecius.com/',
            'customer' => [
                'email' => 'user@example.com',
                'phone_number' => '+237678901234',
                'name' => 'John Doe',
            ],
            ]);


                dd($charge);
            // if ($charge->status === 'successful') {
            //     // Handle successful payment
            // } else {
            //     // Handle failed payment
            // }

    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback()
    {
        
        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {
        
        $transactionID = Flutterwave::getTransactionIDFromCallback();
        $data = Flutterwave::verifyTransaction($transactionID);

        dd($data);
        }
        elseif ($status ==  'cancelled'){
            //Put desired action/code after transaction has been cancelled here
        }
        else{
            //Put desired action/code after transaction has failed here
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here

    }
}