<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset-password/{token}', function (string $token) {
    return view('resetPassword', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::get('/register2',[authController::class,'insertRegister'])->name('insertRegister');
