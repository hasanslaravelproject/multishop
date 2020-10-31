<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Store;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Session;
class AdminController extends Controller
{
    public function login(Request $request){
        $store = Store::where('store_email',$request->input('email'))->where('store_password',$request->input('password'))->first();

        if ($store){
            session(['store_id' => $store->store_id]);
            return view('dashboard.admin');
        }else{
            $super = SuperAdmin::where('sad_email',$request->input('email'))->where('sad_password',$request->input('password'))->first();
            if ($super){
                return view('dashboard.super-admin');
            }else{
                $client = Client::where('cli_email',$request->input('email'))->where('cli_password',$request->input('password'))->first();
               if ($client){
                   session(['cli_id' => $client->cli_id]);
                  return redirect('/');
               }else{
                   return back();
               }
            }
        }

    }
    public function clientlogin(Request $request){
        $client = Client::where('cli_email',$request->input('email'))->where('cli_password',$request->input('password'))->first();
        if ($client){
            session(['store_id' => $client->client_id]);
            return view('dashboard.admin');
        }else{
            $super = SuperAdmin::where('sad_email',$request->input('email'))->where('sad_password',$request->input('password'))->first();
            if ($super){
                return view('dashboard.super-admin');
            }else{
                return back();
            }
        }
    }
    public function logout(){
        Session::flush();
        return view('login');
    }
}
