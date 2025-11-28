<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Support\Arr;

class AuthController extends Controller {
    
    public function login(AuthLoginRequest $request) {

        $validated = $request->validated();

        if (Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ])) {
            
            return response()->json([], 200);
        
        }
        
        return response()->json([
            'message' => 'Credenciais inválidas',
        ], 401);

    }   

    public function logout(Request $request): JsonResponse {
        
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return response()->json([], 200);
    
    }

}
