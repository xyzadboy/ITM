<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PegawaiLoginController;
use App\Http\Controllers\TiketController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
})->name('login');

// Route::get('/tiket', function () {
//     return view('ticket');
// });
Route::get('/tiket', \App\Livewire\TiketFrontend::class);




Route::post('/login', [PegawaiLoginController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [PegawaiLoginController::class, 'logout'])
    ->name('logout');

Route::middleware('auth:pegawai')->group(function () {

    Route::match(['get', 'post'], '/tiket', [TiketController::class, 'form'])
        ->name('tiket.form');

});


