<?php

use App\Http\Controllers\Api\ServiceController;
use Illuminate\Support\Facades\Route;

Route::group(['controller' => ServiceController::class,'prefix' => 'services' ],function(){
    Route::get('/','index');
});