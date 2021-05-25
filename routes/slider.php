<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/slider/'], function () {

        Route::get('list', 'SliderController@index')
            ->name('slider')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'SliderController@create')
            ->name('slider_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'SliderController@store')
            ->name('slider_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'SliderController@destroy')
            ->name('slider_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
                
        /*Route::get('{id}', 'SliderController@show')
            ->name('slider_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'SliderController@edit')
            ->name('slider_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');

        Route::post('{id}', 'SliderController@edit')
            ->name('slider_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}/edit', 'SliderController@update')
            ->name('slider_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});