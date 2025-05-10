<?php

use App\Http\Controllers\Admin\ReservationController;
use Illuminate\Support\Facades\Route;

Route::group(['controller' => ReservationController::class,'prefix' => 'reservations' ],function(){
    Route::patch('confirm/{reservation}','confirm')->name('admin.reservations.confirm');
    Route::patch('reject/{reservation}','reject')->name('admin.reservations.reject');
    Route::patch('done/{reservation}','done')->name('admin.reservations.done');
    Route::get('/','index')->name('admin.reservation.index');
});