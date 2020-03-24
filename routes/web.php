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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::group(['prefix' => '/dns', 'as' => 'dns.'], function (){
    Route::get('/dkim-dmarc-spf', ['as' => 'dkim-dmarc-spf', 'uses' => 'DNSLookupController@getDkimDmarcSpfRecords']);
});
