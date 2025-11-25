<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: '',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (Throwable $throwable, Request $request) {

            if ($request->is('api/*')) {

                $code = method_exists($throwable, 'getStatusCode') ? $throwable->getStatusCode() : 500;
                $message = $code === 500 ? 'Erro interno. Tente novamente mais tarde.' : $throwable->getMessage();
                
                return response()->json([
                    'message' => $message,
                ], $code);

            }
            
        });

    })->create();
