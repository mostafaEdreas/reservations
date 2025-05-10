<?php

use App\Http\Controllers\Client\ReservationController;
use Illuminate\Support\Facades\Route;

    Route::group(['controller' => ReservationController::class,'prefix' => 'reservations' ],function(){
        Route::get('/','index')->name('client.reservations.index');
        Route::patch('cancel/{reservation}','cancel')->name('client.reservations.cancel');
        Route::get('create/{service}','create')->name('client.reservations.create');
        Route::post('store/{service}','store')->name('client.reservations.store');
        Route::get('edit/{reservation}','edit')->name('client.reservations.edit');
        Route::put('update/{reservation}','update')->name('client.reservations.update');
    });