<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\File;

class ProductController extends Controller
{
    public function index(){
        $pro = Product::where('store_id',session('store_id'))->get();
        $cat = Category::where('cat_status',1)->where('store_id',session('store_id'))->get();
        return view('dashboard.product', compact('pro','cat'));

    }
    public function create(Request $request){
        $pro_name = $request->input('pro_name');
        $store_id = session('store_id');
        $pro_id =rand(1000,9999);
        $pro_image = "";
        if ($image = $request->file('pro_image')) {
            $name = $pro_id;
            $extension = $image->getClientOriginalExtension();
            $pro_image = $name . '.' . $extension;
            $path = public_path('image/product');
            $image->move($path, $pro_image);
        }
        Product::create([
            'pro_name' => $pro_name,
            'pro_price' => $request->input('pro_price'),
            'pro_validity' => $request->input('pro_validity'),
            'pro_image' => $pro_image,
            'pro_quantity' => $request->input('pro_quantity'),
            'pro_status' => 0,
            'pro_category' => $request->input('pro_category'),
            'pro_id' => $pro_id,
            'store_id' => $store_id,
        ]);
        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
        ]);

    }
    public function update(Request $request){

        $pro = Product::find($request->input('id4update'));

        Product::where('id',$request->input('id4update'))->update([
            'pro_name'=>$request->input('pro_name'),
            'pro_price' => $request->input('pro_price'),
            'pro_validity' => $request->input('pro_validity'),
            'pro_category' => $request->input('pro_category'),
            'pro_quantity' => $request->input('pro_quantity'),
        ]);


        if ($image = $request->file('pro_image')){
            $image_path = "image/product/$pro->pro_image";
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $name = $pro->pro_image;
            $path = public_path('image/Product');
            $image->move($path, $name);
        }
        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
            "ms" => $pro,
        ]);
    }
    public function status($id){
        $pro = Product::find($id);
        if ($pro->pro_status == 1){
            $pro->pro_status = 0;
            $st = 0;
        }
        else{
            $pro->pro_status = 1;
            $st = 1;

        }
        $pro->save();
        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
            "ms" => $st,
        ]);
    }
    public function getproduct($id){
        $pro = Product::find($id);
        return Response()->json([
            "m" => "Product",
            "ms" => $pro,
        ]);
    }
    public function delete($id){
        $pro = Product::find($id);
        $image_path = "image/product/$pro->pro_image";
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        Product::destroy($id);

        return "success";

    }
}
