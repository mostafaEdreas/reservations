<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//////////////////////// admins routes /////////////////////////////////////////////////
Route::prefix('admin')->middleware('IsAdminApi')->group(function(){

   require('admin/api/service.php');
   require('admin/api/rserevation.php');


    //////////////// starts reservations routes /////////////////////////////
});





//////////////////////// client routes /////////////////////////////////////////////////
Route::middleware('auth:sanctum')->group(function(){

require('client/api/service.php');
require('client/api/reservation.php');

});



Route::prefix('auth')->group(function() {

    Route::post('register', [AuthController::class, 'register']);

    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
});