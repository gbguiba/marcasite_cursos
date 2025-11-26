<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CourseCategoryController;
use App\Http\Controllers\API\CourseController;

Route::get('api/users', [UserController::class, 'index']);
Route::get('api/users/{user}', [UserController::class, 'show']);
Route::delete('api/users/{user}', [UserController::class, 'destroy']);
Route::post('api/users', [UserController::class, 'store']);
Route::put('api/users/{user}', [UserController::class, 'update']);
Route::delete('api/users/{user}/photo', [UserController::class, 'removePhoto']);

Route::get('api/courses/categories', [CourseCategoryController::class, 'index']);
Route::get('api/courses/categories/{courseCategory}', [CourseCategoryController::class, 'show']);
Route::delete('api/courses/categories/{courseCategory}', [CourseCategoryController::class, 'destroy']);
Route::post('api/courses/categories', [CourseCategoryController::class, 'store']);
Route::put('api/courses/categories/{courseCategory}', [CourseCategoryController::class, 'update']);

Route::get('api/courses', [CourseController::class, 'index']);
Route::get('api/courses/{course}', [CourseController::class, 'show']);
Route::delete('api/courses/{course}', [CourseController::class, 'destroy']);
Route::post('api/courses', [CourseController::class, 'store']);
Route::put('api/courses/{course}', [CourseController::class, 'update']);
Route::delete('api/courses/{course}/thumbnail', [CourseController::class, 'removeThumbnail']);
