<?php

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

Route::prefix('importexcel')->group(function() {
    Route::get('/', 'ImportExcelController@index');
    Route::post('submit-data', 'ImportExcelController@import');
    Route::get('export', 'ImportExcelController@export')->name('export-data');
});
