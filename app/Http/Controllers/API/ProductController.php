<?php

namespace App\Http\Controllers\API;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Validator;
use Illuminate\Support\Facades\Auth; 


class ProductController extends Controller
{
    public $successStatus = 200;

    public function CreateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);   
        if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], 401);                        
        }
        if(Auth::user()->role_id < 4){
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->store_id = $request->store_id;
            $product->save();
            return response()->json(['success'=>'Producto agregado exitosamente!','product'=>$product],$this->successStatus);
        }
    }
}
