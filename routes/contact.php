<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/contact/'], function () {

        Route::get('list', 'ContactController@index')
            ->name('contact')
            ->middleware('Admin:CONTACT');
        
        Route::get('create', 'ContactController@create')
            ->name('contact_create')
            ->middleware('Admin:CONTACT');
        
        Route::post('create', 'ContactController@store')
            ->name('contact_store')
            ->middleware('Admin:CONTACT');
        
        Route::get('{id}/delete', 'ContactController@destroy')
            ->name('contact_delete')
            ->middleware('Admin:CONTACT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'ContactController@show')
            ->name('contact_show')
            ->middleware('Admin:CONTACT')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'ContactController@edit')
            ->name('contact_edit')
            ->middleware('Admin:CONTACT')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'ContactController@update')
            ->name('contact_update')
            ->middleware('Admin:CONTACT')
            ->where('id', '[0-9]+');
    });
});