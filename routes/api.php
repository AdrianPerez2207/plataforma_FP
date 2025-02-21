<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Sólo se puede acceder si está autenticado
Route::middleware('auth:sanctum')->group(function () {
    //Courses
    Route::get('/api/v1/courses', [CourseController::class, 'api_index']);
    Route::get('/api/v1/courses/{id}', [CourseController::class, 'api_show']);

    //Users
    Route::get('/api/v1/users/{dni}/inscripciones', [UserController::class, 'api_user_registrations']);
});


