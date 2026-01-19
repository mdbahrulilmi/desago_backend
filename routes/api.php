<?php
// mobile
use App\Http\Controllers\authController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TautkanAkunController;
use App\Http\Controllers\AssetLinksController;
use App\Http\Controllers\FileUploadController;
// web
use App\Http\Controllers\web\AuthControllerWeb;
use App\Http\Middleware\pemilikProfile;

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
	
// for web
Route::prefix('desa')->group(function () {

    Route::post('/login', [AuthControllerWeb::class, 'login'])->name('desa.login');

    Route::post('/register', [AuthControllerWeb::class, 'register'])->name('desa.register');

});

});


Route::middleware(['auth:sanctum'])->group(function(){
	Route::post('/logout',[authController::class,'logout'])->name('logout');
	Route::get('/desa', [DesaController::class, 'getAllDataDesa']);
	Route::get('/profil-desa/{id}', [DesaController::class, 'show']);
	Route::post('/tautkan-akun', [TautkanAkunController::class, 'tautkanAkunUserKeDesa']);
	Route::post('/user/avatar', [ProfileController::class, 'updateAvatar']);
	Route::post('/edit/profile', [ProfileController::class, 'edit_profile'])
    ->middleware('auth:sanctum');
	Route::post('/change-password', [authController::class, 'changePassword'])->name('change_password');
	Route::post('/file-upload', [FileUploadController::class, 'upload'])->name('upload');
	Route::get('/file-retrieve', [FileUploadController::class, 'retrieve'])->name('retrieve');

	
});
