<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use App\Store;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class AuthController extends Controller 
{
 public $successStatus = 200;
  
 /**
  * This function registers an user
  *
  *
  * @param Request $request Request object with name,email,password and c_password
  * @return JSON
  * @throws conditon
  **/
 public function register(Request $request) {    
    $validator = Validator::make($request->all(), [ 
              'name' => 'required',
              'email' => 'required|email',
              'password' => 'required',  
              'c_password' => 'required|same:password', 
    ]);   
    if ($validator->fails()) {          
        return response()->json(['error'=>$validator->errors()], 401);                        
    }    
    $input = $request->all();  
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input); 
    $success['token'] =  $user->createToken('SIMP')->accessToken;

    return response()->json(['success'=>$success], $this->successStatus); 
}
  
/**
 * This function authenticates an user
 *
 *  structure success.token, success.name, success.store, success.id 
 * @return JSON with store, username and authtoken
 **/
public function login(){ 
if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
   $user = Auth::user(); 
   $success['id'] = $user->id;
   $success['token'] =  $user->createToken('SIMP')->accessToken;
   $success['name'] = $user->name;
   $success['store'] = Store::where('user_id','=',$user->id)->get();
    return response()->json(['success' => $success], $this->successStatus); 
  } else{ 
   return response()->json(['error'=>'Unauthorised'], 401); 
   } 
}
/**
 * This function returns the current user
 *
 * @return User
 **/
public function getUser() {
    $user = Auth::user();
    return response()->json(['success' => $user], $this->successStatus); 
}
} 