<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/clientcategorie/'], function () {

        Route::get('list', 'ClientcategorieController@index')
            ->name('clientcategorie')
            ->middleware('Admin:CLIENTCATEGORIE');
        
        Route::get('create', 'ClientcategorieController@create')
            ->name('clientcategorie_create')
            ->middleware('Admin:CLIENTCATEGORIE');
        
        Route::post('create', 'ClientcategorieController@store')
            ->name('clientcategorie_store')
            ->middleware('Admin:CLIENTCATEGORIE');
        
        Route::get('{id}/delete', 'ClientcategorieController@destroy')
            ->name('clientcategorie_delete')
            ->middleware('Admin:CLIENTCATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}', 'ClientcategorieController@show')
            ->name('clientcategorie_show')
            ->middleware('Admin:CLIENTCATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::get('{id}/edit', 'ClientcategorieController@edit')
            ->name('clientcategorie_edit')
            ->middleware('Admin:CLIENTCATEGORIE')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'ClientcategorieController@update')
            ->name('clientcategorie_update')
            ->middleware('Admin:CLIENTCATEGORIE')
            ->where('id', '[0-9]+');
    });
});