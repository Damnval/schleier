<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    Route::get('/send-invitation', [UserController::class], 'SendInvitation');

Route::group([
    'prefix' => 'admin',  
    // 'middleware' => ['admin'] can be improved by adding middleware
    // where admin users can only send invitation 
], function(){

    Route::post('/send-invitation', [UserController::class, 'sendInvitation']); 
});


Route::group([
    'prefix' => 'users',  
    // 'middleware' => ['user'] can be improved by adding middleware
    // where type users can only access these routes
], function(){

    Route::post('', [UserController::class, 'store']);  
    Route::post('/verify', [UserController::class, 'verifyUser']);
    Route::patch('/{id}', [UserController::class, 'update']);
});