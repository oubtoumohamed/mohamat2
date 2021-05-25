<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/larabase/translator'], function () {
        
        Route::get('/{lang?}/{module?}', 'Oubtou\Larabase\Translator\TranslatorController@create')
            ->name('translator_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('/create', 'Oubtou\Larabase\Translator\TranslatorController@store')
            ->name('translator_store')
            ->middleware('Admin:ADMIN');
    });
});