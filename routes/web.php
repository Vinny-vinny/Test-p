<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::get('/home', 'ExchangeController@index')->name('home');
    Route::get('/', 'ExchangeController@index')->name('return-ticker');
    Route::get('/chart-data', 'ExchangeController@chartData')->name('chart-data');
    Route::get('/trade-history', 'ExchangeController@tradeHistory')->name('trade-history');
});

