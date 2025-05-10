<?php

use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Client\ReservationController as ClientReservationController;
use App\Http\Controllers\Client\ServiceController as ClientServiceController;
use App\Http\Controllers\ProfileController;
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

Route::get('/',[ServiceController::class,'index'])->name('client.services.index')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//////////////////////// admins routes /////////////////////////////////////////////////
Route::prefix('admin')->middleware('IsAdmin')->group(function(){

require('admin/web/service.php');

require('admin/web/reservation.php');

    //////////////// starts reservations routes /////////////////////////////
});





//////////////////////// client routes /////////////////////////////////////////////////
Route::middleware('auth')->group(function(){

require('client/web/service.php');
require('client/web/reservation.php');

//////////////// starts reservations routes /////////////////////////////
});

