<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;

use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{


    public function login(LoginRequest $request){
        
      // return "login";
            if (!Auth::attempt($request->all())) {
                  return response([
                  'message'=>"invalid credential"],403);
              }
              return response([
                  'user'=>auth()->user(),
                  'token'=>auth()->user()->createToken(auth()->user()->name)->plainTextToken
                      ],200);
              }
 
 
 
 
     public function logout(){
      if (auth()->check()) {
        auth()->user()->tokens()->delete();
        return response([
          'message'=>"Logout successfully",
      ],200);
      }
        return response([
          'message'=>"invalid credential",
      ],200);
     }

     public function user(){
     return new UserResource(auth()->user());
     }
 
}
