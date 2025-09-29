<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WordsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [StudentController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [StudentController::class, 'register']);

Route::get('/login', [StudentController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StudentController::class, 'login']);

Route::post('/logout', [StudentController::class, 'logout'])->name('logout');

Route::middleware('auth:student')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->guard('student')->user();
        $words = $user->words()->latest()->get();
        return view('students.dashboard', compact('user', 'words'));
    })->name('dashboard');
    Route::get('/words/{letter}/{word}', [WordsController::class, 'edit'])->name('words.edit');
    Route::get('/words/{letter}/{word}', 'WordsController@destroy')->name('words.destroy');
    Route::get('/profile', [StudentController::class, 'show'])->name('students.index');
    Route::get('/words', [WordsController::class, 'index'])->name('index');
    Route::get('/words/create', [WordsController::class, 'create'])->name('words.create');
    Route::post('/words', [WordsController::class, 'store'])->name('words.store');
    Route::get('/words/{letter}', [WordsController::class, 'show'])->name('words.show');
});
