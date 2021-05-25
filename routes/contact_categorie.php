<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/contactcategorie/'], function () {

        Route::get('list', 'ContactcategorieController@index')
            ->name('contactcategorie')
            ->middleware('Admin:CONTACTCATEGORIE');
        
        Route::get('create', 'ContactcategorieController@create')
            ->name('contactcategorie_create')
            ->middleware('Admin:CONTACTCATEGORIE');
        
        Route::post('create', 'ContactcategorieController@store')
            ->name('contactcategorie_store')
            ->middleware('Admin:CONTACTCATEGORIE');
        
        Route::get('{id}/delete', 'ContactcategorieController@destroy')
            ->name('contactcategorie_delete')
            ->middleware('Admin:CONTACTCATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'ContactcategorieController@show')
            ->name('contactcategorie_show')
            ->middleware('Admin:CONTACTCATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'ContactcategorieController@edit')
            ->name('contactcategorie_edit')
            ->middleware('Admin:CONTACTCATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'ContactcategorieController@update')
            ->name('contactcategorie_update')
            ->middleware('Admin:CONTACTCATEGORIE')
            ->where('id', '[0-9]+');
    });
});