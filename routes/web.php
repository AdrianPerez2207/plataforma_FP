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
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/myCourses', [CourseController::class, 'studentCourses'])->name('myCourses');
    Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::put('/registrations/update', [RegistrationController::class, 'update'])->name('registrations.update');
    Route::get('/{course}/materials', [CourseMaterialController::class, 'materialByCourse'])->name('material.byCourse');

    /**
     * We need to generate a new token for the user.
     */
    Route::get('/token/create', function (Request $request) {
        $token = $request->user()->createToken('token');
        return ['token' => $token->plainTextToken];
    });

});

require __DIR__.'/auth.php';
