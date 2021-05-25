<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/client/'], function () {

        Route::get('list', 'ClientController@index')
            ->name('client')
            ->middleware('Admin:CLIENT');
        
        Route::get('create', 'ClientController@create')
            ->name('client_create')
            ->middleware('Admin:CLIENT');
        
        Route::post('create', 'ClientController@store')
            ->name('client_store')
            ->middleware('Admin:CLIENT');
        
        Route::get('{id}/delete', 'ClientController@destroy')
            ->name('client_delete')
            ->middleware('Admin:CLIENT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'ClientController@show')
            ->name('client_show')
            ->middleware('Admin:CLIENT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'ClientController@edit')
            ->name('client_edit')
            ->middleware('Admin:CLIENT')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'ClientController@update')
            ->name('client_update')
            ->middleware('Admin:CLIENT')
            ->where('id', '[0-9]+');
    });
});