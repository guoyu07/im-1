<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/1/22
 * Time: 下午4:49
 */

Route::get('login','LoginController@login');
Route::post('login','LoginController@doLogin');
Route::get('index','IndexController@index');



Route::get('/', function () {

    return view('welcome');
});