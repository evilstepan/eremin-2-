<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

// Маршрут для отображения формы логина
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Маршрут для обработки логина
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Главная страница
Route::get('/', function () {
    return view('welcome');
});

// Защищенные маршруты
Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', TicketController::class);
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Публичные маршруты для комментариев
Route::resource('comments', CommentController::class)->only(['index', 'show']);

// Маршрут для домашней страницы
Route::get('/home', [HomeController::class, 'index'])->name('home');