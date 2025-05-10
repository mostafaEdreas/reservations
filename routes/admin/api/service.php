<?php 
 //////////////// starts services routes /////////////////////////////

use App\Http\Controllers\Api\ServiceController;
use Illuminate\Support\Facades\Route;

 Route::group(['controller' => ServiceController::class,'prefix' => 'services' ],function(){
    Route::patch('change-status','changeStatus');
    Route::get('active','active');
    Route::get('/',  'index');
    Route::post('/',  'store');
    Route::get('{service}',  'show');
    Route::put('{service}',  'update');
    Route::delete('{service}',  'destroy');
});


/////////////////// end services routes ////////////////////////////////