<?php

namespace App\Http\Controllers\API;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; 
use Validator;


class StoreController extends Controller{

    public $successStatus = 200;
    /**
     * This function create a store and relates it to a user type owner
     *
     *
     * @param Request $request request with store name,NIT or document, address and phone
     **/
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
        return response()->json(['fail'=>'El usuario no es un dueño de tienda'],401);
    }

    /**
     * Returns all the products of a given store
     *
     * Returns all products of a given store with all its properties
     *
     * @param Request $request store_id of the store
     **/
    public function GetProducts(Request $request){
        $store = Store::find($request->store_id);
        $products = $store->products;
        return response()->json(['success'=>$products],$this->successStatus);
    }

    /**
     * This function sells a given amount of products from the store
     *
     *
     * @param Request $request
     **/
    public function SellProducts(Request $request)
    {
        // $products = $request->products;
        return response()->json($request->products);
    }
}