<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/act/'], function () {

        Route::get('list', 'ActController@index')
            ->name('act')
            ->middleware('Admin:ACT');
        
        Route::get('create', 'ActController@create')
            ->name('act_create')
            ->middleware('Admin:ACT');
        
        Route::post('create', 'ActController@store')
            ->name('act_store')
            ->middleware('Admin:ACT');
        
        Route::get('{id}/delete', 'ActController@destroy')
            ->name('act_delete')
            ->middleware('Admin:ACT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'ActController@show')
            ->name('act_show')
            ->middleware('Admin:ACT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'ActController@edit')
            ->name('act_edit')
            ->middleware('Admin:ACT')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'ActController@update')
            ->name('act_update')
            ->middleware('Admin:ACT')
            ->where('id', '[0-9]+');
    });
});