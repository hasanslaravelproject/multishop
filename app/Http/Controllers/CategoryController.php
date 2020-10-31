<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Session;

class CategoryController extends Controller
{
    public function index(){
        $cat = Category::where('store_id',session('store_id'))->get();
        return view('dashboard.category', compact('cat'));

    }
    public function create(Request $request){
        $cat_name = $request->input('cat_name');
         $store_id = session('store_id');
         $cat_id =rand(1000,9999);
         $cat_image = "";
        if ($image = $request->file('cat_image')) {
            $name = $cat_id;
            $extension = $image->getClientOriginalExtension();
            $cat_image = $name . '.' . $extension;
            $path = public_path('image/category');
            $image->move($path, $cat_image);
        }
        Category::create([
            'cat_name' => $cat_name,
            'cat_image' => $cat_image,
            'cat_status' => 0,
            'cat_id' => $cat_id,
            'store_id' => $store_id,
        ]);
        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
        ]);

    }
    public function update(Request $request){

        $cat = Category::find($request->input('id4update'));

        Category::where('id',$request->input('id4update'))->update([
            'cat_name'=>$request->input('cat_name'),

        ]);


        if ($image = $request->file('cat_image')){
            $image_path = "image/category/$cat->cat_image";
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $name = $cat->cat_image;
            $path = public_path('image/category');
            $image->move($path, $name);
        }
        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
            "ms" => $cat,
        ]);
    }
    public function status($id){
        $cat = Category::find($id);
        if ($cat->cat_status == 1){
            $cat->cat_status = 0;
            $st = 0;
        }
        else{
            $cat->cat_status = 1;
            $st = 1;

        }
        $cat->save();
        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
            "ms" => $st,
        ]);
    }
    public function getcategory($id){
        $cat = Category::find($id);
        return Response()->json([
            "m" => "category",
            "ms" => $cat,
        ]);
    }
    public function delete($id){
        $cat = Category::find($id);
        $image_path = "image/category/$cat->cat_image";
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        Category::destroy($id);

        return "success";

    }
}
