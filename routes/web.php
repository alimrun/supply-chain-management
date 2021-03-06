<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*Auth::routes();*/

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace'=>'Company','prefix'=>'company','as'=>'company.'], function () {
    Route::group(['namespace'=>'Auth','prefix'=>'auth','as'=>'auth.'], function () {
        Route::get('login','LoginController@login')->name('login');
        Route::post('login','LoginController@submit');
        Route::post('logout','LoginController@logout')->name('logout');
    });

    Route::group(['middleware'=>'company'], function () {
        Route::get('dashboard','DashboardController@dashboard')->name('dashboard');
    });
});


Route::group(['namespace'=>'Supplier','prefix'=>'supplier','as'=>'supplier.'], function () {
    Route::group(['namespace'=>'Auth','prefix'=>'auth','as'=>'auth.'], function () {
        Route::get('login','LoginController@login')->name('login');
        Route::post('login','LoginController@submit');
        Route::post('logout','LoginController@logout')->name('logout');
    });
});
