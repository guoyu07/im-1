<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/1/22
 * Time: 下午4:49
 */

Route::get('login','LoginController@login');
Route::post('login','LoginController@doLogin');
Route::get('register','RegisterController@showRegistrationForm');
Route::post('register','RegisterController@register');
Route::POST('webhooks','IndexController@webhooks');



Route::group(['middleware' => ['auth.im']], function ($route) {
    $route->get('/','IndexController@index');
    $route->get('init','IndexController@init');
    $route->get('find','IndexController@find');
    $route->get('msgBox','MessageBoxController@index');
    $route->post('uploadImage','IndexController@uploadImage');
    $route->post('uploadFile','IndexController@uploadFile');
});
