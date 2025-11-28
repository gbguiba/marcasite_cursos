<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsUser {
    
    public function handle(Request $request, Closure $next): Response {

        if (Auth::user()->type !== 'user') {
            
            throw new HttpException(403, 'Você não tem permissão para continuar.');
        
        }
        
        return $next($request);
    
    }
}
