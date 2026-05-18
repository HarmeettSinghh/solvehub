<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Browse questions (public)
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
Route::get('/questions/{slug}', [QuestionController::class, 'show'])->name('questions.show');

// Public user profile
Route::get('/user/{id}', [UserProfileController::class, 'show'])->name('user.profile');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Question CRUD (create, edit, update, delete require auth)
    Route::get('/ask', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{slug}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{slug}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/questions/{slug}', [QuestionController::class, 'destroy'])->name('questions.destroy');

    // Answers
    Route::post('/questions/{id}/answers', [AnswerController::class, 'store'])->name('answers.store');
    Route::put('/answers/{id}', [AnswerController::class, 'update'])->name('answers.update');
    Route::delete('/answers/{id}', [AnswerController::class, 'destroy'])->name('answers.destroy');
    Route::post('/answers/{id}/accept', [AnswerController::class, 'accept'])->name('answers.accept');

    // Voting (supports AJAX)
    Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');

    // Profile settings (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
    Route::delete('/questions/{id}', [AdminController::class, 'deleteQuestion'])->name('questions.delete');
    Route::delete('/answers/{id}', [AdminController::class, 'deleteAnswer'])->name('answers.delete');
});

// Auth routes (from Breeze)
require __DIR__.'/auth.php';
