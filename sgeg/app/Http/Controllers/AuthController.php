<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function CreateUser(UserRequest $request) {
        $user = User::create( [
            'name' => env('MAIL_FROM_NAME'),
            'eamil' => env('MAIL_FROM_ADDRESS'),
            'password' => Hash::make(env('MAIL_FROM_NAME'))
        ]);
        //Comunicación con el frontal
        return response()->json([
            'status' => true,
            'message' => 'User created',
            //Hay que generar el token del usuario, sactun proporcionan esa funcion
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
    }

    public function loginUser(LoginRequest $request) {
        //Auth::user(); todos los datos del usuario
        //Auth::user->email;

        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'status' =>false,
                'message' => 'User do not match'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        
        return response()->json([
            'status' => true,
            'message' => 'User logged',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
    }
}
