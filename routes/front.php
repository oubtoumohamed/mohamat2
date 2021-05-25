<?php

Route::get('/', 'FrontController@index')->name('front_home');

Route::get('/admin/setting', 'FrontController@setting')->name('front_setting');
Route::post('/admin/setting', 'FrontController@store')->name('front_setting_store');
Route::get('/articles', 'FrontController@articles')->name('front_articles');
Route::get('/{cat}/articles', 'FrontController@cat_articles')->name('front_cat_articles');
Route::get('/article/{lien}', 'FrontController@article')->name('front_article');

Route::get('/page/{link}', 'PageController@front')->name('page_front');

Route::get('/slider/{link}', 'SliderController@front')->name('slider_front');

