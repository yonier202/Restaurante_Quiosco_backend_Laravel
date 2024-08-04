<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroRequest;

class AuthController extends Controller
{
    
    public function register(RegistroRequest $request){
        //validar eñ registro
        $data = $request->validated();

        //guardar en la base de datos
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        
        $token = $user->createToken('token')->plainTextToken;
        
        return response()->json([
            'token' => $token,
            'user' => $user,
        ],);
    }
    public function login(LoginRequest $request){
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            return response([
                'errors' => ['Credenciales incorrectas']
            ], 422);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
        

    }
    public function logout(Request $request){
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return [
            'user' => null
        ];

    }
}
