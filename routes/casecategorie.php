<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/casecategorie/'], function () {

        Route::get('list', 'CasecategorieController@index')
            ->name('casecategorie')
            ->middleware('Admin:CASECATEGORIE');
        
        Route::get('create', 'CasecategorieController@create')
            ->name('casecategorie_create')
            ->middleware('Admin:CASECATEGORIE');
        
        Route::post('create', 'CasecategorieController@store')
            ->name('casecategorie_store')
            ->middleware('Admin:CASECATEGORIE');
        
        Route::get('{id}/delete', 'CasecategorieController@destroy')
            ->name('casecategorie_delete')
            ->middleware('Admin:CASECATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'CasecategorieController@show')
            ->name('casecategorie_show')
            ->middleware('Admin:CASECATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'CasecategorieController@edit')
            ->name('casecategorie_edit')
            ->middleware('Admin:CASECATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'CasecategorieController@update')
            ->name('casecategorie_update')
            ->middleware('Admin:CASECATEGORIE')
            ->where('id', '[0-9]+');
    });
});