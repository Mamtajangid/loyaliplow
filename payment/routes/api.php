<?php

use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\MainController;
use App\Http\Controllers\API\UserTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// ** Start Payment**//
Route::get('getAllPayment',[MainController::class,'getAllPayment']);
Route::get('getPaymentId',[MainController::class,'getPaymentId']);
Route::post('postPayment',[MainController::class,'postPayment']);
Route::Delete('deletePaymentId',[MainController::class,'deletePaymentId']);
Route::post('updatePayment',[MainController::class,'updatePayment']);
//**End Payment* *//

// **User Type **//
Route::apiResource('usertype',UserTypeController::class);
//**End User Type */

// ** Start Images**//
Route::get('getAllImage',[ImageController::class,'getAllImage']);
Route::get('getImageId',[ImageController::class,'getImageId']);
Route::post('postImages',[ImageController::class,'postImages']);
Route::Delete('deleteImageId',[ImageController::class,'deleteImageId']);
Route::post('updateImage',[ImageController::class,'updateImage']);
//**End Images* *//