<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Guest Authentication
Route::middleware('guest')->group(function () {

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.submit');

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');
});

// Authenticated Users
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Courses - View and Search
    Route::get('/courses', [CourseController::class, 'index'])
        ->name('courses.index');

    // Materials - View
    Route::get('/materials', [MaterialController::class, 'index'])
        ->name('materials.index');

    // Feedback - User
    Route::get('/feedback/create', [FeedbackController::class, 'create'])
        ->name('feedback.create');

    Route::post('/feedback', [FeedbackController::class, 'store'])
        ->name('feedback.store');

    // Admin Only
    Route::middleware('role:admin')->group(function () {

        // Courses CRUD
        Route::get('/courses/create', [CourseController::class, 'create'])
            ->name('courses.create');

        Route::post('/courses', [CourseController::class, 'store'])
            ->name('courses.store');

        Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])
            ->name('courses.edit');

        Route::put('/courses/{course}', [CourseController::class, 'update'])
            ->name('courses.update');

        Route::delete('/courses/{course}', [CourseController::class, 'destroy'])
            ->name('courses.destroy');

        // Materials CRUD
        Route::get('/materials/create', [MaterialController::class, 'create'])
            ->name('materials.create');

        Route::post('/materials', [MaterialController::class, 'store'])
            ->name('materials.store');

        Route::get('/materials/{material}/edit', [MaterialController::class, 'edit'])
            ->name('materials.edit');

        Route::put('/materials/{material}', [MaterialController::class, 'update'])
            ->name('materials.update');

        Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])
            ->name('materials.destroy');

        // Feedback Management
        Route::get('/feedback', [FeedbackController::class, 'index'])
            ->name('feedback.index');

        Route::put('/feedback/{feedback}/status', [FeedbackController::class, 'updateStatus'])
            ->name('feedback.updateStatus');

        Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])
            ->name('feedback.destroy');
    });
});