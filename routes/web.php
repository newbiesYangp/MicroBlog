<?php

Route::get('/','StaticPagesController@home')->name('home'); //主页
Route::get('/help','StaticPagesController@help')->name('help');//帮助页
Route::get('/about','StaticPagesController@about')->name('about');//关于页

Route::get('/signup','UsersController@create')->name('signup'); //注册
Route::resource('users','UsersController');

Route::get('login','SessionController@create')->name('login');
Route::post('login','SessionController@store')->name('login');
Route::delete('logout','SessionController@destroy')->name('logout');

//注册激活
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

