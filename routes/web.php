<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::middleware(['auth'])->group(function () {
    // Главная страница
    Route::get('/', function () {
        return view('home');  // Теперь home.blade.php будет доступен
    })->name('home');
    Route::get('books/download/{id}', [BookController::class, 'download'])->name('books.download');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Ресурсы для книг
    Route::resource('books', BookController::class);
});



// Страница панели инструментов для авторизованных пользователей
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Защищенные маршруты для профиля пользователя
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Маршруты для аутентификации, доступные только неавторизованным пользователям
Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Маршрут для выхода
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Подключаем аутентификацию из auth.php
require __DIR__.'/auth.php';
