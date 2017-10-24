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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('profil', 'UserController@TampilUbahProfil')->name('profil');

    Route::group(['prefix' => 'edit'], function(){

        Route::get('password',[
            'uses' => 'UserController@ubahPassword',
            'as' => 'edit.password'
        ]);

        Route::get('profil',[
            'uses' => 'UserController@ubahProfil',
            'as' => 'edit.profil'
        ]);

    });
});


