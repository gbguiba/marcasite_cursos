<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CourseCategoryController;

Route::get('api/users', [UserController::class, 'index']);
Route::get('api/users/{user}', [UserController::class, 'show']);
Route::delete('api/users/{user}', [UserController::class, 'destroy']);
Route::post('api/users', [UserController::class, 'store']);
Route::put('api/users/{user}', [UserController::class, 'update']);

Route::get('api/courses/categories', [CourseCategoryController::class, 'index']);
Route::get('api/courses/categories/{courseCategory}', [CourseCategoryController::class, 'show']);
Route::delete('api/courses/categories/{courseCategory}', [CourseCategoryController::class, 'destroy']);
Route::post('api/courses/categories', [CourseCategoryController::class, 'store']);
Route::put('api/courses/categories/{courseCategory}', [CourseCategoryController::class, 'update']);