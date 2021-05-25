<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/larabase/modulecreator'], function () {
        
        Route::get('/', 'Oubtou\Larabase\ModuleCreator\ModuleCreatorController@create')
            ->name('modulecreator_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('/create', 'Oubtou\Larabase\ModuleCreator\ModuleCreatorController@store')
            ->name('modulecreator_store')
            ->middleware('Admin:ADMIN');
    });
});