<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/stage/'], function () {

        Route::get('list', 'StageController@index')
            ->name('stage')
            ->middleware('Admin:STAGE');
        
        Route::get('create', 'StageController@create')
            ->name('stage_create')
            ->middleware('Admin:STAGE');
        
        Route::post('create', 'StageController@store')
            ->name('stage_store')
            ->middleware('Admin:STAGE');
        
        Route::get('{id}/delete', 'StageController@destroy')
            ->name('stage_delete')
            ->middleware('Admin:STAGE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'StageController@show')
            ->name('stage_show')
            ->middleware('Admin:STAGE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'StageController@edit')
            ->name('stage_edit')
            ->middleware('Admin:STAGE')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'StageController@update')
            ->name('stage_update')
            ->middleware('Admin:STAGE')
            ->where('id', '[0-9]+');
    });
});