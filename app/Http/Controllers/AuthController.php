<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;


class AuthController extends Controller
{
    function register(Request $request){
        $fields = $request->validate([
            "name" =>"required",
            "email" =>"required|email|unique:users,email",
            "password" => "required|confirmed",
            "user_type" => "required",
            
            // "password" => "required|confirmed"

        ]);

        $user = User::create([
            "name" => $fields["name"],
            "email" => $fields["email"],
            "password" => Hash::make($fields["password"]),
            "user_type" => $fields["user_type"],
        ]);

        return response()->json([
            "message" => "User created successfully"
        ], 201, [], JSON_PRETTY_PRINT);
    }
    //Login method
    function login(Request $request) {
        // $fields = $request->validate([
        //     "email" => "required|email",
        //     "password" => "required",
        // ]);
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::where("email", $credentials["email"])->first();
        // $token = "";
        // if(!$user) {
        //     return response()->json([
        //         "message" => "Invalid credentials",
        //         "isError" => true,
        //     ], 401, [], JSON_PRETTY_PRINT);
        // }
       
            if (Auth::attempt($credentials)) {
                $token = $user->createToken("Personal Access Token")->plainTextToken;
            }else{
                return response()->json([
                    "message" => "Incorrect email or password!",
                    "isError" => true,
                ], 401, [], JSON_PRETTY_PRINT);
            }
        
        
        return response()->json([
            "message" => "Logged in successfully",
            "user" => $user,
            "token" => $token,
            "isError" => false,

        ], 200, [], JSON_PRETTY_PRINT);
    }
    function getLoggedUser(){
        
        return response()->json([
            "user" => Auth::user()

        ], 200, [], JSON_PRETTY_PRINT);
        // return response()->json([
        //     "message" => "Logged in successfully",
        //     "token" => $id,
        //     "isError" => false,

        // ], 200, [], JSON_PRETTY_PRINT);
      
    }
    function logoutUser(Request $request){
        Auth::guard('sanctum')->user()->tokens()->delete();
 
        return response()->json([
            "message" => "Logged out successfully",
            "isError" => false,

        ], 200, [], JSON_PRETTY_PRINT);
      
    }
}
