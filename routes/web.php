<?php

use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengurusanKTPController;
use App\Http\Controllers\PengurusanKartuKeluargaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('penduduk', PendudukController::class);
Route::resource('pengurusanktp', PengurusanKTPController::class);
Route::resource('pengurusankartukeluarga', PengurusanKartuKeluargaController::class);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('CheckPreviousLogin');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('CheckPreviousLogin');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});
