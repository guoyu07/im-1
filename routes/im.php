<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/1/22
 * Time: 下午4:49
 */

Route::get('login','LoginController@login');
Route::post('login','LoginController@doLogin');
Route::post('register','RegisterController@register');
Route::get('logout','LoginController@logout');
Route::get('user/index','UserController@index');

Route::get('/', function () {

    return view('welcome');
});