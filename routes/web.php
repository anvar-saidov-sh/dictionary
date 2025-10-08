<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScholarsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WordRequestController;
use App\Http\Controllers\WordsController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

Route::controller(StudentController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware('auth:student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [StudentController::class, 'show'])->name('students.index');

    Route::controller(WordsController::class)->group(function () {
        Route::get('/words', 'index')->name('index');
        Route::get('/words/create', 'create')->name('words.create');
        Route::post('/words', 'store')->name('words.store');
        Route::get('/words/{letter}', 'show')->name('words.show');
        Route::get('/words/{letter}/{word}/review', 'review')->name('words.review');
        Route::get('/words/{letter}/{word}/edit', 'edit')->name('words.edit');
        Route::put('/words/{letter}/{word}', 'update')->name('words.update');
        Route::delete('/words/{letter}/{word}', 'destroy')->name('words.destroy');
    });

    Route::controller(WordRequestController::class)->group(function () {
        Route::get('/words/{letter}/{word}/request', 'create')->name('words.requests.create');
        Route::post('/words/{letter}/{word}/request', 'store')->name('words.requests.store');
        Route::post('/requests/{id}/approve', 'approve')->name('requests.approve');
        Route::post('/requests/{id}/reject', 'reject')->name('requests.reject');
    });
});

Route::prefix('scholar')->controller(ScholarsController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('scholar.login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('scholar.logout');
});

Route::middleware('auth:scholar')->prefix('scholar')->name('scholar.')->group(function () {
    Route::get('/dashboard', [ScholarsController::class, 'dashboard'])->name('dashboard');
    Route::get('/pendingwords', [ScholarsController::class, 'pendingWords'])->name('pendingwords');
    Route::get('/reviewedwords', [ScholarsController::class, 'reviewedWords'])->name('reviewedwords');
    Route::get('/pendingrequests', [ScholarsController::class, 'pendingRequests'])->name('pendingrequests');
    Route::get('/reviewedrequests', [ScholarsController::class, 'reviewedRequests'])->name('reviewedrequests');

    // Approvals / rejections (both direct and request-based)
    Route::post('/approve/{id}', [ScholarsController::class, 'approve'])->name('approve');
    Route::post('/reject/{id}', [ScholarsController::class, 'reject'])->name('reject');
    Route::post('/requests/{id}/approve', [WordRequestController::class, 'approveByScholar'])->name('requests.approve');
    Route::post('/requests/{id}/reject', [WordRequestController::class, 'rejectByScholar'])->name('requests.reject');
});
