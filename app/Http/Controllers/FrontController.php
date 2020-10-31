<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Package;
use App\Models\Product;
use App\Models\Store;
use App\Models\Client;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $store = Store::where('store_status',1)->get();

        return view('frontend.home.index',compact('store'));
    }
    public function viewstore($store_id){
     if (session('cli_id')){
         $cli = Client::where('cli_id',session('cli_id'))->first();
         if ($cli->cli_package == 0){
             session(['store_id_wait' => $store_id]);
             $packs = Package::where('pack_status',1)->get();
             return view('frontend.home.pack',compact('packs'));
         }else{
             $store = Store::where('store_id',$store_id)->first();
             $cat = Category::where('store_id',$store_id)->get();
             $pro =Product::where('store_id',$store_id)->get();
             return view('frontend.home.singlestore', compact('store','cat','pro'));
         }
     }else{
         session(['store_id_wait' => $store_id]);
         $packs = Package::where('pack_status',1)->get();
         return view('frontend.home.pack',compact('packs'));
     }

    }
    public  function subscribe($pack_id){
        $packs = Package::find($pack_id);
        if (session('cli_id')){
            session(['pay_amount' => $packs->pack_price]);
            session(['select_pack' => $pack_id]);
            return view('payment.pay');
        }else{
            return view('login');
        }


    }
    public function ProductPayment($payment){
        session(['pay_amount' => $payment]);
        return view('payment.pay');
    }
    public function clientReg(Request $request){
        $user = $request->input('email');
        $name = $request->input('name');
        $pass = $request->input('password');
        $id = rand(1000,9999);

        Client::create([
            'cli_name' => $name,
            'cli_email' =>$user,
            'cli_password' => $pass,
            'cli_image' => "N/A",
            'cli_id' => $id,
            'cli_package' => 0,
            'cli_validation' =>0,
            'cli_status' => 0,
        ]);
        session(['cli_id' => $id]);
        $packs = Package::where('pack_status',1)->get();
        return view('frontend.home.pack',compact('packs'));
    }
    public function addToCart($id)
    {
        $product = Product::find($id);

        if(!$product) {

            abort(404);

        }
        session(['cart_ready' => "yes"]);

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $id => [
                    "pro_id" => $product->pro_id,
                    "store_id" => $product->store_id,
                    "name" => $product->pro_name,
                    "quantity" => 1,
                    "price" => $product->pro_price,
                    "photo" => $product->pro_image
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "pro_id" => $product->pro_id,
            "name" => $product->pro_name,
            "store_id" => $product->store_id,
            "quantity" => 1,
            "price" => $product->pro_price,
            "photo" => $product->pro_image
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function cart()
    {
        return view('frontend.home.cart');
    }

}
