<?php

    //////////////// starts services routes /////////////////////////////

use App\Http\Controllers\Client\ServiceController;
use Illuminate\Support\Facades\Route;

    Route::group(['controller' => ServiceController::class,'prefix' => 'services' ],function(){
        Route::get('/','index')->name('client.services.index');
    });

    /////////////////// end services routes ////////////////////////////////