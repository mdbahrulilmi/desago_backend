<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TautkanAkunController;
use App\Http\Controllers\AssetLinksController;
use App\Http\Middleware\pemilikProfile;
use App\Http\Controllers\FileUploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//test mail
use Illuminate\Notifications\Messages\MailMessage;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware(['guest'])->group(function(){

	// Auth Endpoints
	Route::post('/login',[authController::class,'login'])->name('login');
	Route::post('/register',[authController::class,'register'])->name('register');
	Route::post('/forgot-password', [authController::class, 'sendResetLink'])->name('password.forgot');
	Route::post('/loginGoogle',[authController::class,'googleLogin']);
	Route::get('/auth/redirect', [authController::class,'redirect'])->name('redirect');
	Route::get('/auth/{provider}/callback', [authController::class,'callback'])->name('callback');
	Route::get('/sendSMS', [authController::class, 'sendMessage']);
	Route::post('/new-password', [authController::class, 'resetPassword'])->name('password.update');
	Route::post('/token-expired', [authController::class, 'tokenExpired']);
	// Route::post('/new-password', function(Request $request) {
	// return $request->all();
	// })->name('password.update');
	// Desa Endpoint

	//testing mail

	Route::get('/preview-email', function () {
	
		$resetUrl = 'http://londa-proinsurance-nonsalubriously.ngrok-free.dev/reset-password?token=50d7efde1414c0dd6956c9bf6da87e99635b6bba3b3dd245c633459ffec39802&email=sunankarebet@gmail.com';
	
		$mailMessage = (new MailMessage)
			->subject('Reset Kata Sandi - DesaGO')
			->greeting('Halo Bilqis !')
			->line('Klik tombol di bawah untuk reset kata sandi')
			->action('Reset Kata Sandi', $resetUrl)
			->line('Tautan ini akan kedaluwarsa dalam 60 menit.')
			->line('Jika Anda tidak meminta reset kata sandi, abaikan email ini.')
			->salutation('Tim DesaGO');
	
		return $mailMessage->render();
	});
	



});


Route::middleware(['auth:sanctum'])->group(function(){
	Route::post('/logout',[authController::class,'logout'])->name('logout');
	Route::get('/desa', [DesaController::class, 'getAllDataDesa']);
	Route::get('/profile-desa/{id}', [DesaController::class, 'show']);
	Route::post('/tautkan-akun', [TautkanAkunController::class, 'tautkanAkunUserKeDesa']);
	Route::post('/user/avatar', [ProfileController::class, 'updateAvatar']);
	Route::post('/edit/profile/{id}', [ProfileController::class, 'edit_profile'])->name('edit_profile')->middleware('pemilikProfile');
	Route::post('/change-password', [authController::class, 'changePassword'])->name('change_password');
	Route::post('/file-upload', [FileUploadController::class, 'upload'])->name('upload');
	Route::get('/file-retrieve', [FileUploadController::class, 'retrieve'])->name('retrieve');

	
});
