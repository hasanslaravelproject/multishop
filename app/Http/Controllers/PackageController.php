<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
        $pack = Package::all();
        return view('dashboard.package', compact('pack'));

    }
    public function create(Request $request){
        $pack_id =rand(1000,9999);

        Package::create([
            'pack_name' => $request->input('pack_name'),
            'pack_price' => $request->input('pack_price'),
            'pack_validity' => $request->input('pack_validity'),
            'pack_status' => 0,
            'pack_id' => $pack_id,
        ]);
        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
        ]);

    }
    public function update(Request $request){

        $pack = Package::find($request->input('id4update'));

        Package::where('id',$request->input('id4update'))->update([
            'pack_name' => $request->input('pack_name'),
            'pack_price' => $request->input('pack_price'),
            'pack_validity' => $request->input('pack_validity'),
        ]);

        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
            "ms" => $pack,
        ]);
    }
    public function status($id){
        $pack = Package::find($id);
        if ($pack->pack_status == 1){
            $pack->pack_status = 0;
            $st = 0;
        }
        else{
            $pack->pack_status = 1;
            $st = 1;

        }
        $pack->save();
        return Response()->json([
            "success" => true,
            "title" => "Success!!!",
            "status" => "success",
            "ms" => $st,
        ]);
    }
    public function getpackage($id){
        $pack = Package::find($id);
        return Response()->json([
            "m" => "Package",
            "ms" => $pack,
        ]);
    }
    public function delete($id){
        Package::destroy($id);

        return "success";

    }
}
