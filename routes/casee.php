<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/casee/'], function () {

        Route::get('list', 'CaseeController@index')
            ->name('casee')
            ->middleware('Admin:CASEE');
        
        Route::get('create', 'CaseeController@create')
            ->name('casee_create')
            ->middleware('Admin:CASEE');
        
        Route::post('create', 'CaseeController@store')
            ->name('casee_store')
            ->middleware('Admin:CASEE');
        
        Route::get('{id}/delete', 'CaseeController@destroy')
            ->name('casee_delete')
            ->middleware('Admin:CASEE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'CaseeController@show')
            ->name('casee_show')
            ->middleware('Admin:CASEE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'CaseeController@edit')
            ->name('casee_edit')
            ->middleware('Admin:CASEE')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'CaseeController@update')
            ->name('casee_update')
            ->middleware('Admin:CASEE')
            ->where('id', '[0-9]+');
    });
});