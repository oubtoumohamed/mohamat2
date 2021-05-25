<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/service/'], function () {

        Route::get('list', 'ServiceController@index')
            ->name('service')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'ServiceController@create')
            ->name('service_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'ServiceController@store')
            ->name('service_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'ServiceController@destroy')
            ->name('service_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'ServiceController@show')
            ->name('service_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'ServiceController@edit')
            ->name('service_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'ServiceController@update')
            ->name('service_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
    });
});