<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/article/'], function () {

        Route::get('list', 'ArticleController@index')
            ->name('article')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'ArticleController@create')
            ->name('article_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'ArticleController@store')
            ->name('article_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'ArticleController@destroy')
            ->name('article_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'ArticleController@show')
            ->name('article_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'ArticleController@edit')
            ->name('article_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');

        Route::get('{id}', 'ArticleController@edit')
            ->name('article_show')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}/edit', 'ArticleController@update')
            ->name('article_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});