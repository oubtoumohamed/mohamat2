<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/lawyer/'], function () {

        Route::get('list', 'LawyerController@index')
            ->name('lawyer')
            ->middleware('Admin:LAWYER');
        
        Route::get('create', 'LawyerController@create')
            ->name('lawyer_create')
            ->middleware('Admin:LAWYER');
        
        Route::post('create', 'LawyerController@store')
            ->name('lawyer_store')
            ->middleware('Admin:LAWYER');
        
        Route::get('{id}/delete', 'LawyerController@destroy')
            ->name('lawyer_delete')
            ->middleware('Admin:LAWYER')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'LawyerController@show')
            ->name('lawyer_show')
            ->middleware('Admin:LAWYER')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'LawyerController@edit')
            ->name('lawyer_edit')
            ->middleware('Admin:LAWYER')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'LawyerController@update')
            ->name('lawyer_update')
            ->middleware('Admin:LAWYER')
            ->where('id', '[0-9]+');
    });
});