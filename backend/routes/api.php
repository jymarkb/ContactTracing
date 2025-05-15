<?php

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
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('checkMobile','EstablishmentController@checkMobile');
Route::post('sendCode','EstablishmentController@sendCode');
Route::post('setAccount', 'EstablishmentController@setAccount');
Route::post('loginAccount', 'EstablishmentController@login');
Route::post('updatePinES', 'EstablishmentController@updatePin');

Route::post('forgot/checkAccount', 'EstablishmentController@forgotCheckAccount');
Route::post('forgot/sendCode','EstablishmentController@forgotSendCode');
Route::post('forgot/updateNewPIN','EstablishmentController@updateNewPIN');

Route::post('password/checkAccount', 'EstablishmentController@passwordCheckAccount');
Route::post('password/sendCode', 'EstablishmentController@passwordSendCode');
Route::post('password/updateNewPassword', 'EstablishmentController@updateNewPassword');

Route::post('update/scanQRcode', 'EstablishmentController@updateScanQRcode');
Route::post('update/citizenTags', 'EstablishmentController@citizenTags');