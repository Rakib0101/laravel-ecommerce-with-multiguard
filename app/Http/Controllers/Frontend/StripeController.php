<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function StripeOrder(Request $request){



        \Stripe\Stripe::setApiKey('sk_test_51KD5r7F2NFuyTuJd1UXTqXBsSxWjqTRYMs1nC60j0WNWqN1GmnEhaDv7StzXBUfMbGGvcWgmrf7ebPJYOpKq6MT700nVWLl84s');


        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
          'amount' => 999*100,
          'currency' => 'usd',
          'description' => 'Easy Online Store',
          'source' => $token,
          'metadata' => ['order_id' => '6735'],
        ]);

        dd($charge);




        } // end method
}
