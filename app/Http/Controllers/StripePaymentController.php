<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Package;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Session;
use Stripe;
class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('payment.pay');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $st = session('store_id');

        if (session('cart_ready') == "yes"){
            $state = 0;
            $sto = "N/A";
        }else{

            $sto = $st;
            $state = 1;
        }
       $s = Stripe\Charge::create ([
            "amount" => session('pay_amount') * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment",
            "metadata" => [
              "total" =>   session('pay_amount'),
               "clint" => session('cli_id'),
                "store" => $sto,
            ],
        ]);



        if ($state == 1){
            $pa = Package::where('id', session('select_pack'))->first();
            $hour = $pa->validity * 24;
            $expireday = date("Y-m-d H:i:s", strtotime('+'.$hour.' hours'));

            Client::where('cli_id',session('cli_id'))->update([
                'cli_package' => $pa->pack_id,
                'cli_validation' =>$expireday,
            ]);
        }else{
          foreach (session('cart') as $c => $details){
              ProductOrder::create([
                  'cli_id' => session('cli_id'),
                  'pro_id' =>  $details['pro_id'],
                  'store_id' => $details['store_id'],
                  'pro_price' => $details['price'],
                  'pro_quantity' => $details['quantity'],
                  'delivery_status' => 0,
            ]);
          }

            session(['cart' => ""]);
        }




        Session::flash('success', 'Payment successful!');

        return back();
    }
}
