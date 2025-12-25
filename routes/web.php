<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetLinksController;
use Carbon\Carbon;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/.well-known/assetlinks.json', [AssetLinksController::class, 'show']);
// Route::get('/reset-password/{token}', function (string $token) {
//     return view('resetPassword', ['token' => $token]);
// })->middleware('guest')->name('password.reset');
Route::get('/reset-password', function (Illuminate\Http\Request $request) {
    $token = $request->query('token');
    $email = $request->query('email');
    $appLink = "com.desago.app://reset-password/?token={$token}&email={$email}";
    return redirect()->away($appLink);
})->middleware('guest')->name('password.reset');
// Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/open-app', function (Request $request) {
    $token = $request->token ?? '';
    $email = $request->email ?? '';

    return redirect()->away("myapp://password-baru?token=$token&email=$email");
});


// Route::get('/reset-password/{token}', function ($token) {
//     $email = request('email');

//     // redirect ke deep link aplikasi
//     $appLink = "myapp://reset-password/$token?email=$email";

//     return redirect()->away($appLink);
// })->middleware('guest')->name('password.reset');

// Route::get('/reset-password', function (Request $request) {
//     $token = $request->query('token');
//     $email = $request->query('email');

//     // bisa render view web / landing page
//     return view('reset-password', compact('token', 'email'));
// });

// Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::get('/register2',[authController::class,'insertRegister'])->name('insertRegister');
