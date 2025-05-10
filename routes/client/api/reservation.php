<?php

use App\Http\Controllers\Api\ReservationController;
use Illuminate\Support\Facades\Route;

Route::group(['controller' => ReservationController::class,'prefix' => 'reservations' ],function(){
    Route::patch('cancel/{reservation_id}','cancel');
    Route::post('store/{service_id}','store');
    Route::put('update/{reservation_id}','update');
    Route::get('index','index');
    
});