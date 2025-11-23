<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiController extends Controller
{
   
    public function token(Request $request)
    {
        $credentials = $request->only('email','password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message'=>'Invalid credentials'], 401);
        }

        return response()->json([
            'message'=>'Login successful',
            'access_token'=>$token,
            'token_type'=>'Bearer'
        ]);
    }


}
