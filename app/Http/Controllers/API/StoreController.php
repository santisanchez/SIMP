<?php

namespace App\Http\Controllers\API;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; 
use Validator;


class StoreController extends Controller{

    public $successStatus = 200;

    public function CreateStore(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'document_number' => 'required',
            'address' => 'required',  
            'phone' => 'required',
        ]);
        if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], 401);                        
        }
        if(Auth::user()->role_id == 2){
            $store = new Store;
            $store->name = $request->name;
            $store->document_number = $request->document_number;
            $store->address = $request->address;
            $store->phone = $request->phone;
            $store->user_id = Auth::user()->id;
            $store->save();
            return response()->json(['success'=>'Tu tienda ha sido creada exitosamente'],$this->successStatus);
        }
        return response()->json(['fail'=>'No se pudo registrar tu tienda'],401);
    }

    public function GetProducts(Request $request){
        $store = Store::find($request->store_id);
        $products = $store->products;
        return response()->json(['success'=>$products],$this->successStatus);
    }
}