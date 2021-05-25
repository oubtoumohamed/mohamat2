<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/appointment/'], function () {

        Route::get('list', 'AppointmentController@index')
            ->name('appointment')
            ->middleware('Admin:APPOINTMENT');
        
        Route::get('create', 'AppointmentController@create')
            ->name('appointment_create')
            ->middleware('Admin:APPOINTMENT');
        
        Route::post('create', 'AppointmentController@store')
            ->name('appointment_store')
            ->middleware('Admin:APPOINTMENT');
        
        Route::get('{id}/delete', 'AppointmentController@destroy')
            ->name('appointment_delete')
            ->middleware('Admin:APPOINTMENT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'AppointmentController@show')
            ->name('appointment_show')
            ->middleware('Admin:APPOINTMENT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'AppointmentController@edit')
            ->name('appointment_edit')
            ->middleware('Admin:APPOINTMENT')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'AppointmentController@update')
            ->name('appointment_update')
            ->middleware('Admin:APPOINTMENT')
            ->where('id', '[0-9]+');
    });
});