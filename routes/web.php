<?php

Route::get('/','StaticPagesController@home')->name('home'); //主页
Route::get('/help','StaticPagesController@help')->name('help');//帮助页
Route::get('/about','StaticPagesController@about')->name('about');//关于页
Route::get('/signup','UsersController@create')->name('signup'); //注册

Route::resource('users','UsersController');
