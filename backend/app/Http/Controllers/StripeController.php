<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        // Set the Stripe API key using the value from the .env file
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    
        // Check if the stripeToken is provided in the request
        if (!$request->has('stripeToken')) {
            // Handle the case where stripeToken is missing
            Session::flash('error', 'Payment source is missing.');
            return back();
        }
    
        try {
            \Stripe\Charge::create([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
            ]);
    
            Session::flash('success', 'Payment successful!');
            return back();
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Handle Stripe API validation errors
            Session::flash('error', $e->getMessage());
            return back();
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle other Stripe API errors
            Session::flash('error', 'Payment failed. Please try again later.');
            return back();
        }
    }
    
}
