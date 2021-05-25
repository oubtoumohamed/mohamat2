<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/leave/'], function () {

        Route::get('list', 'LeaveController@index')
            ->name('leave')
            ->middleware('Admin:LEAVE');
        
        Route::get('create', 'LeaveController@create')
            ->name('leave_create')
            ->middleware('Admin:LEAVE');
        
        Route::post('create', 'LeaveController@store')
            ->name('leave_store')
            ->middleware('Admin:LEAVE');
        
        Route::get('{id}/delete', 'LeaveController@destroy')
            ->name('leave_delete')
            ->middleware('Admin:LEAVE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'LeaveController@show')
            ->name('leave_show')
            ->middleware('Admin:LEAVE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'LeaveController@edit')
            ->name('leave_edit')
            ->middleware('Admin:LEAVE')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'LeaveController@update')
            ->name('leave_update')
            ->middleware('Admin:LEAVE')
            ->where('id', '[0-9]+');
    });
});