<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Authenticated {
    
    public function handle(Request $request, Closure $next): Response {

        if (Auth::user() === null) {

            throw new HttpException(401, 'Entre em sua conta para continuar.');

        }

        return $next($request);
    
    }

}
