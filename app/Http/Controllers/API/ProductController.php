<?php

namespace App\Http\Controllers\API;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Validator;
use Illuminate\Support\Facades\Auth; 


class ProductController extends Controller
{
    public $SUCCESS_STATUS = 200;
    public $FAILURE_STATUS = 401;


    /**
     * This function creates a product to a store
     *
     * Create a product and relates it to the current store
     *
     * @param Request $request object with name,price,quantity and store_id
     * 
     **/
    public function CreateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);   
        if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], $this->FAILURE_STATUS);                        
        }
        if(Auth::user()->role_id < 4){
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->store_id = $request->store_id;
            $product->save();
            return response()->json(['success'=>'Producto agregado exitosamente!','product'=>$product],$this->SUCCESS_STATUS);
        }
        return response()->json(['error'=>'Los productos unicamente son agregados por el dueño'],$this->FAILURE_STATUS);
    }

    
}
