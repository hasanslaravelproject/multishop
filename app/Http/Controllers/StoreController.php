<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $store = Store::all();
        return view('admin.store', compact('store'));

    }
    public function create(Request $request){

        $store_name = $request->input('store_name');
        $store_id =rand(1000,9999);
        $store_image = "";
        if ($image = $request->file('store_image')) {
            $name = $store_id;
            $extension = $image->getClientOriginalExtension();
            $store_image = $name . '.' . $extension;
            $path = public_path('image/store');
            $image->move($path, $store_image);
        }
        Store::create([
            'store_name' => $store_name,
            'store_details' => $request->input('store_details'),
            'store_email' => $request->input('store_email'),
            'store_password' => $request->input('store_password'),
            'store_image' => $store_image,
            'store_status' => 0,
            'store_id' => $store_id,
        ]);
        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
        ]);

    }
    public function update(Request $request){

        $store = Store::find($request->input('id4update'));

        Store::where('id',$request->input('id4update'))->update([
            'store_name' => $request->input('store_name'),
            'store_details' => $request->input('store_details'),
            'store_email' => $request->input('store_email'),
            'store_password' => $request->input('store_password'),
        ]);


        if ($image = $request->file('store_image')){
            $image_path = "image/store/$store->store_image";
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $name = $store->store_image;
            $path = public_path('image/Store');
            $image->move($path, $name);
        }
        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
            "ms" => $store,
        ]);
    }
    public function status($x){
        $store = Store::find($x);
        if ($store->store_status == 1){
            $store->store_status = 0;
            $st = 0;
        }
        else{
            $store->store_status = 1;
            $st = 1;

        }
        $store->save();
        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
            "ms" => $st,
        ]);
    }
    public function getstore($id){
        $store = Store::find($id);
        return Response()->json([
            "m" => "Store",
            "ms" => $store,
        ]);
    }
    public function delete($id){
        $store = Store::find($id);
        $image_path = "image/store/$store->store_image";
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        Store::destroy($id);

        return "success";

    }
}
