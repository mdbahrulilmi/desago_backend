<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TautkanAkunController;
use App\Http\Middleware\pemilikProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware(['guest'])->group(function(){

	// Auth Endpoints
	Route::post('/login',[authController::class,'login'])->name('login');
	Route::post('/register',[authController::class,'register'])->name('register');
	Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
	Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
	Route::post('/loginGoogle',[authController::class,'googleLogin']);
	Route::get('/auth/redirect', [authController::class,'redirect'])->name('redirect');
	Route::get('/auth/{provider}/callback', [authController::class,'callback'])->name('callback');
	Route::get('/sendSMS', [authController::class, 'sendMessage']);

	// Desa Endpoint
	

});


Route::middleware(['auth:sanctum'])->group(function(){
	Route::get('/logout',[authController::class,'logout'])->name('logout');
	Route::get('/desa', [DesaController::class, 'getAllDataDesa']);
	Route::post('/tautkan-akun', [TautkanAkunController::class, 'tautkanAkunUserKeDesa']);
	Route::post('/user/avatar', [ProfileController::class, 'updateAvatar']);
	Route::post('/edit/profile/{id}', [ProfileController::class, 'edit_profile'])->name('edit_profile')->middleware('pemilikProfile');
});
