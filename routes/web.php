<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chat', [MessageController::class, 'chat'])->name('chat');
    Route::get('/messages/{user}', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{chatId}', [MessageController::class, 'store'])->name('messages.store');
});
Route::post('/test', [MessageController::class, 'test']);

require __DIR__ . '/auth.php';
