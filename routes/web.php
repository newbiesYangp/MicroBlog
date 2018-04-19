<?php

Route::get('/','StaticPagesController@home'); //主页
Route::get('/help','StaticPagesController@help');//帮助页
Route::get('/about','StaticPagesController@about');//关于页
