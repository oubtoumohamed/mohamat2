<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/courtcategorie/'], function () {

        Route::get('list', 'CourtcategorieController@index')
            ->name('courtcategorie')
            ->middleware('Admin:COURTCATEGORIE');
        
        Route::get('create', 'CourtcategorieController@create')
            ->name('courtcategorie_create')
            ->middleware('Admin:COURTCATEGORIE');
        
        Route::post('create', 'CourtcategorieController@store')
            ->name('courtcategorie_store')
            ->middleware('Admin:COURTCATEGORIE');
        
        Route::get('{id}/delete', 'CourtcategorieController@destroy')
            ->name('courtcategorie_delete')
            ->middleware('Admin:COURTCATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'CourtcategorieController@show')
            ->name('courtcategorie_show')
            ->middleware('Admin:COURTCATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'CourtcategorieController@edit')
            ->name('courtcategorie_edit')
            ->middleware('Admin:COURTCATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'CourtcategorieController@update')
            ->name('courtcategorie_update')
            ->middleware('Admin:COURTCATEGORIE')
            ->where('id', '[0-9]+');
    });
});