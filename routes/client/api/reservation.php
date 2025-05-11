<?php

use App\Http\Controllers\Api\ReservationController;
use Illuminate\Support\Facades\Route;

Route::group(['controller' => ReservationController::class,'prefix' => 'reservations' ],function(){
    Route::patch('cancel/{reservation}','cancel');
    Route::post('store/{service}','store');
    Route::put('update/{reservation}','update');
    Route::get('user','listForUser');

});
