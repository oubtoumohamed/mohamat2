<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/categorie/'], function () {

        Route::get('list', 'CategorieController@index')
            ->name('categorie')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'CategorieController@create')
            ->name('categorie_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'CategorieController@store')
            ->name('categorie_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'CategorieController@destroy')
            ->name('categorie_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'CategorieController@show')
            ->name('categorie_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'CategorieController@edit')
            ->name('categorie_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');

        Route::get('{id}', 'CategorieController@edit')
            ->name('categorie_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}/edit', 'CategorieController@update')
            ->name('categorie_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});