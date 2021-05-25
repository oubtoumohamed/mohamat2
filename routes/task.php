<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/task/'], function () {

        Route::get('list', 'TaskController@index')
            ->name('task')
            ->middleware('Admin:TASK');
        
        Route::get('create', 'TaskController@create')
            ->name('task_create')
            ->middleware('Admin:TASK');
        
        Route::post('create', 'TaskController@store')
            ->name('task_store')
            ->middleware('Admin:TASK');
        
        Route::get('{id}/delete', 'TaskController@destroy')
            ->name('task_delete')
            ->middleware('Admin:TASK')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'TaskController@show')
            ->name('task_show')
            ->middleware('Admin:TASK')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'TaskController@edit')
            ->name('task_edit')
            ->middleware('Admin:TASK')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'TaskController@update')
            ->name('task_update')
            ->middleware('Admin:TASK')
            ->where('id', '[0-9]+');
    });
});