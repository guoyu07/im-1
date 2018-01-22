<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/1/22
 * Time: 下午4:49
 */

Route::get('login','LoginController@showLoginForm');
Route::get('register','RegisterController@showRegistrationForm');
Route::post('register','RegisterController@register');
Route::get('logout','LoginController@logout');

Route::get('/', function () {
    return view('welcome');
});