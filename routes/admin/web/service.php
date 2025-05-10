<?php

    //////////////// starts services routes /////////////////////////////

use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;

    Route::group(['controller' => ServiceController::class,'prefix' => 'services' ],function(){
        Route::patch('change-status/{service}','changeStatus')->name('admin.services.change-status');
    });
    Route::resource('services', ServiceController::class)
    ->except(['show'])
    ->names('admin.services');
    /////////////////// end services routes ////////////////////////////////