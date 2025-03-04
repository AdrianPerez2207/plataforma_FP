<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Access is only allowed if authenticated.
 */
Route::middleware('auth:sanctum')->group(function () {
    //Get
    Route::get('/v1/courses', [CourseController::class, 'api_index']);
    Route::get('/v1/courses/{id}', [CourseController::class, 'api_show']);
    Route::get('/v1/users/{dni}/registrations', [UserController::class, 'api_user_registrations']);

    //POST
    Route::post('/v1/registrations', [RegistrationController::class, 'api_new_registration']);

    //DELETE
    Route::delete('v1/registrations/{id}', [RegistrationController::class, 'api_delete_registration']);
});

/**
 * Only administrators or teachers can create new courses.
 */
Route::middleware(['auth:sanctum', 'role:teacher,admin'])->group(function () {
    Route::post('/v1/courses', [CourseController::class, 'api_new_course']);
});

/**
 * Only administrators can delete courses.
 */
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::delete('v1/courses/{id}', [CourseController::class, 'api_delete_course']);
});



