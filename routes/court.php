<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/court/'], function () {

        Route::get('list', 'CourtController@index')
            ->name('court')
            ->middleware('Admin:COURT');
        
        Route::get('create', 'CourtController@create')
            ->name('court_create')
            ->middleware('Admin:COURT');
        
        Route::post('create', 'CourtController@store')
            ->name('court_store')
            ->middleware('Admin:COURT');
        
        Route::get('{id}/delete', 'CourtController@destroy')
            ->name('court_delete')
            ->middleware('Admin:COURT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'CourtController@show')
            ->name('court_show')
            ->middleware('Admin:COURT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'CourtController@edit')
            ->name('court_edit')
            ->middleware('Admin:COURT')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'CourtController@update')
            ->name('court_update')
            ->middleware('Admin:COURT')
            ->where('id', '[0-9]+');
    });
});