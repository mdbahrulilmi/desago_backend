<?php
//mobile xxx
use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetLinksController;
use Carbon\Carbon;
//web xx
use App\Http\Controllers\web\AuthControllerWeb;

//mobile
Route::get('/', function () {
    return view('welcome');
});
Route::get('/.well-known/assetlinks.json', [AssetLinksController::class, 'show']);
Route::get('/reset-password', function (Illuminate\Http\Request $request) {
    $token = $request->query('token');
    $email = $request->query('email');
    $appLink = "com.desago.app://reset-password/?token={$token}&email={$email}";
    return redirect()->away($appLink);
})->middleware('guest')->name('password.reset');
Route::get('/register2',[authController::class,'insertRegister'])->name('insertRegister');

//web
//noAuth
