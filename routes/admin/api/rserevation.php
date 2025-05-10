<?php

use App\Http\Controllers\Api\ReservationController;
use Illuminate\Support\Facades\Route;

    Route::group(['controller' => ReservationController::class,'prefix' => 'reservations' ],function(){
        Route::patch('confirm/{reservation}','confirm');
        Route::patch('reject/{reservation}','reject');
        Route::patch('done/{reservation}','done');
        Route::get('/','index');
    });