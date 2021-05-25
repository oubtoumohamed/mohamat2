<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/page/'], function () {

        Route::get('list', 'PageController@index')
            ->name('page')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'PageController@create')
            ->name('page_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'PageController@store')
            ->name('page_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'PageController@destroy')
            ->name('page_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
                
        /*Route::get('{id}', 'PageController@show')
            ->name('page_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'PageController@edit')
            ->name('page_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');

        Route::get('{id}', 'PageController@edit')
            ->name('page_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}/edit', 'PageController@update')
            ->name('page_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});