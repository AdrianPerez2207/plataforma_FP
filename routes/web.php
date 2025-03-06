<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseMaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'index'])->name('welcome');

Route::middleware(['auth', 'verified', 'role:teacher,admin'])->group(function () {
    Route::get('/dashboard', [CourseController::class, 'dashboardIndex'])->name('dashboard');
    Route::get('/newCourse', [CourseController::class, 'newCourse'])->name('newCourse');
    Route::post('/create', [CourseController::class, 'create'])->name('create');
    Route::get('/{course}/modify', [CourseController::class, 'modify'])->name('courses.modify');
    Route::put('/courses/update/{course}', [CourseController::class, 'update'])->name('courses.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Courses
    Route::get('/myCourses', [CourseController::class, 'studentCourses'])->name('myCourses');
    Route::get('/{course}/materials', [CourseMaterialController::class, 'materialByCourse'])->name('material.byCourse');
    Route::post('/search', [CourseController::class, 'search'])->name('courses.search');
    Route::post('/myCourses/search', [CourseController::class, 'mySearch'])->name('myCourses.search');
    //Registrations
    Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::put('/registrations/update', [RegistrationController::class, 'update'])->name('registrations.update');


    /**
     * We need to generate a new token for the user.
     */
    Route::get('/token/create', function (Request $request) {
        $token = $request->user()->createToken('token');
        return ['token' => $token->plainTextToken];
    });

});

require __DIR__.'/auth.php';
