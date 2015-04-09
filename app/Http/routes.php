<?php

/**
 * The home Page
 */
Route::get('/', 'PagesController@home');

Route::get('notices/confirm', 'NoticesController@confirm');
Route::resource('notices', 'NoticesController');

/**
 * Authentication
 */
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
