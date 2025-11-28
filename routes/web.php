<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CourseCategoryController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\CourseMaterialController;
use App\Http\Controllers\API\EnrollmentController;
use App\Http\Controllers\API\AuthController;
use App\Http\Middleware\Authenticated;

Route::get('api/auth/login', [AuthController::class, 'login']);

Route::middleware([Authenticated::class,])->group(function() {
    
    Route::delete('api/auth/logout', [AuthController::class, 'logout']);
    
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
    
    Route::get('api/courses/materials', [CourseMaterialController::class, 'index']);
    Route::get('api/courses/materials/{courseMaterial}', [CourseMaterialController::class, 'show']);
    Route::delete('api/courses/materials/{courseMaterial}', [CourseMaterialController::class, 'destroy']);
    Route::post('api/courses/materials', [CourseMaterialController::class, 'store']);
    Route::put('api/courses/materials/{courseMaterial}', [CourseMaterialController::class, 'update']);
    
    Route::get('api/courses/{course}/enrollments', [EnrollmentController::class, 'index']);
    Route::get('api/courses/enrollments/{enrollment}', [EnrollmentController::class, 'show']);
    Route::delete('api/courses/enrollments/{enrollment}', [EnrollmentController::class, 'destroy']);
    Route::post('api/courses/enrollments', [EnrollmentController::class, 'store']);
    Route::post('api/courses/enrollments/{enrollment}', [EnrollmentController::class, 'update'])->name('api.enrollments.webhook');
    
    Route::get('api/courses', [CourseController::class, 'index']);
    Route::get('api/courses/{course}', [CourseController::class, 'show']);
    Route::delete('api/courses/{course}', [CourseController::class, 'destroy']);
    Route::post('api/courses', [CourseController::class, 'store']);
    Route::put('api/courses/{course}', [CourseController::class, 'update']);
    Route::delete('api/courses/{course}/thumbnail', [CourseController::class, 'removeThumbnail']);
    

});

Route::get('/{any}', function () {
    
    return view('welcome');

})->where('any', '.*');
