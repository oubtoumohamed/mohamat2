<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::group(['middleware' => 'web'], function () {
    Route::group(['middleware' => 'auth'], function () {
		Route::get('/home', 'HomeController@index')->name('home');
    });
});

Route::get('lang/{lang}', function($lang){
	if (array_key_exists($lang, Config::get('languages'))) {
		Session::put('applocale', $lang);
	}
	return Redirect::back();
})->name('setlange');


Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/translator'], function () {
        
        Route::get('/{lang?}/{module?}', 'TranslatorController@create')
            ->name('translator_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('/create', 'TranslatorController@store')
            ->name('translator_store')
            ->middleware('Admin:ADMIN');
    });
});
//Route::get('/', 'HomeController@index')->name('home');


include 'article.php';
include 'categorie.php';
include 'front.php';
include 'page.php';
include 'slider.php';

include 'media.php';
include 'user.php';
include 'groupe.php';
include 'contact_categorie.php';
include 'contact.php';
include 'clientcategorie.php';
include 'client.php';
include 'stage.php';
include 'casecategorie.php';
include 'act.php';
include 'lawyer.php';
include 'courtcategorie.php';
include 'appointment.php';
include 'task.php';
include 'court.php';
include 'casee.php';
include 'todo.php';
include 'event.php';
include 'leavetype.php';
include 'leave.php';
include 'service.php';
include 'team.php';