<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/event/'], function () {

        Route::get('list', 'EventController@index')
            ->name('event')
            ->middleware('Admin:EVENT');
        
        Route::get('create', 'EventController@create')
            ->name('event_create')
            ->middleware('Admin:EVENT');
        
        Route::post('create', 'EventController@store')
            ->name('event_store')
            ->middleware('Admin:EVENT');
        
        Route::get('{id}/delete', 'EventController@destroy')
            ->name('event_delete')
            ->middleware('Admin:EVENT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'EventController@show')
            ->name('event_show')
            ->middleware('Admin:EVENT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'EventController@edit')
            ->name('event_edit')
            ->middleware('Admin:EVENT')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'EventController@update')
            ->name('event_update')
            ->middleware('Admin:EVENT')
            ->where('id', '[0-9]+');
    });
});