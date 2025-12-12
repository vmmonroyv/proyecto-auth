<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use Laravel\Socialite\Socialite;

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('custom.auth');

Route::get('/welcome_guest', function () {
    return view('welcome_guest');
})->name('welcome.guest');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*Route::get('/google-auth/redirect',function(){
    return Socialite::driver('google')->redirect();
})->name('google.login');
Route::get('/google-auth/callback',function(){
    $user = Socialite::driver('google')->user();
    $user = User::updateCreate([
        'google_id' => $user_google->id,
    ],
    [
        'name' => $user_google->name,
        'email' => $user_google->email,
    ]);
    Auth::login($user);
    return redirect('/dashboard');
    //$user->token
});
*/


Route::get('/google-auth/redirect', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/google-auth/callback', [GoogleController::class, 'callback']);

require __DIR__.'/auth.php';
