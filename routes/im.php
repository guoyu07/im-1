<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/1/22
 * Time: 下午4:49
 */

Route::get('login','LoginController@login');
Route::get('register','RegisterController@showRegistrationForm');
Route::post('register','RegisterController@register');
Route::post('login','LoginController@doLogin');


Route::group(['middleware' => ['auth.im']], function ($route) {
    $route->get('/','IndexController@index');
    $route->get('friends','UserController@friends');
});
