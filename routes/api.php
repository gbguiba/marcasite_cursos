<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Route::get('api/users', [UserController::class, 'index']);
Route::get('api/users/{user}', [UserController::class, 'show']);
Route::delete('api/users/{user}', [UserController::class, 'destroy']);
Route::post('api/users', [UserController::class, 'store']);
