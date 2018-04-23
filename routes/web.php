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

//密码重置
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request'); //显示重置密码的邮箱发送页面
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email'); //邮箱发送重设链接
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');  //密码更新页面
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');  //执行密码更新操作

//微博创建与删除
Route::resource('statuses','StatusesController',['only'=>['store','destroy']]);