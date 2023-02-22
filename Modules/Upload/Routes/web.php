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

Route::prefix('upload')->group(function() {
    Route::get('/', 'UploadController@index')->name('uload_home');
    
    Route::post('/save_file', 'UploadController@savefile')->name('upload_savefile');
});


