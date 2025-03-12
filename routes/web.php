<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseMaterialController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'index'])->name('welcome');
Route::get('/presentation', function () {
    return view('user.presentation');
})->name('presentation');

Route::middleware(['auth', 'verified', 'role:teacher,admin'])->group(function () {
    //Courses
    Route::get('/dashboard', [CourseController::class, 'dashboardIndex'])->name('dashboard');
    Route::get('/newCourse', [CourseController::class, 'newCourse'])->name('newCourse');
    Route::get('/{course}/modify', [CourseController::class, 'modify'])->name('courses.modify');
    Route::get('/courses/destroy/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
    Route::get('/courses/finished/{course}', [CourseController::class, 'finished'])->name('course.finished');
    Route::post('/courses/update/{course}', [CourseController::class, 'update'])->name('courses.update');

    //Users sólo pueden entrar los administradores
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboardUser', [UserController::class, 'dashboardUser'])->name('dashboardUser');
        Route::get('/newUser', [UserController::class, 'newUser'])->name('newUser');
        Route::get('/users/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::post('/create', [CourseController::class, 'create'])->name('create');
        Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
    });

    //Registrations
    Route::get('/dashboardRegistration/{user}', [RegistrationController::class, 'dashboardRegistration'])->name('dashboardRegistration');
    Route::get('/registrations/change/{registration}', [RegistrationController::class, 'change'])->name('registration.change');
    Route::get('/registrations/cancelled/{registration}', [RegistrationController::class, 'cancelled'])->name('registration.cancelled');

    //Evaluations
    Route::get('/dashboardEvaluations/{user}', [EvaluationController::class, 'dashboardEvaluations'])->name('dashboardEvaluations');
    Route::get('/newEvaluation/{registration}', [EvaluationController::class, 'newEvaluation'])->name('newEvaluation');
    Route::post('/evaluations/create/{registration}', [EvaluationController::class, 'create'])->name('evaluation.create');

    //Materials
    Route::get('/materials/{course}', [CourseMaterialController::class, 'index'])->name('materials.index');
    Route::post('/materials/create/{course}', [CourseMaterialController::class, 'create'])->name('materials.create');
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
