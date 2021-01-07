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
Route::get("new-return-ticker",'ExchangeController@getNewTicker');
Route::get("new-trade-history",'ExchangeController@getNewTradeHistory');
Route::get("new-chart-data",'ExchangeController@getNewChartData');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
