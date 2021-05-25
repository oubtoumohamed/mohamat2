<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/team/'], function () {

        Route::get('list', 'TeamController@index')
            ->name('team')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'TeamController@create')
            ->name('team_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'TeamController@store')
            ->name('team_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'TeamController@destroy')
            ->name('team_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'TeamController@show')
            ->name('team_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'TeamController@edit')
            ->name('team_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'TeamController@update')
            ->name('team_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
    });
});