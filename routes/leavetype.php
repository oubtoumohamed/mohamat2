<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/leavetype/'], function () {

        Route::get('list', 'LeavetypeController@index')
            ->name('leavetype')
            ->middleware('Admin:LEAVETYPE');
        
        Route::get('create', 'LeavetypeController@create')
            ->name('leavetype_create')
            ->middleware('Admin:LEAVETYPE');
        
        Route::post('create', 'LeavetypeController@store')
            ->name('leavetype_store')
            ->middleware('Admin:LEAVETYPE');
        
        Route::get('{id}/delete', 'LeavetypeController@destroy')
            ->name('leavetype_delete')
            ->middleware('Admin:LEAVETYPE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'LeavetypeController@show')
            ->name('leavetype_show')
            ->middleware('Admin:LEAVETYPE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'LeavetypeController@edit')
            ->name('leavetype_edit')
            ->middleware('Admin:LEAVETYPE')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'LeavetypeController@update')
            ->name('leavetype_update')
            ->middleware('Admin:LEAVETYPE')
            ->where('id', '[0-9]+');
    });
});