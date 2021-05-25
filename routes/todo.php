<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/todo/'], function () {

        Route::get('list', 'TodoController@index')
            ->name('todo')
            ->middleware('Admin:TODO');
        
        Route::get('create', 'TodoController@create')
            ->name('todo_create')
            ->middleware('Admin:TODO');
        
        Route::post('create', 'TodoController@store')
            ->name('todo_store')
            ->middleware('Admin:TODO');
        
        Route::get('{id}/delete', 'TodoController@destroy')
            ->name('todo_delete')
            ->middleware('Admin:TODO')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'TodoController@show')
            ->name('todo_show')
            ->middleware('Admin:TODO')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'TodoController@edit')
            ->name('todo_edit')
            ->middleware('Admin:TODO')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'TodoController@update')
            ->name('todo_update')
            ->middleware('Admin:TODO')
            ->where('id', '[0-9]+');
    });
});