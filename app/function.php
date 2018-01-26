<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/1/23
 * Time: 上午9:30
 */

if (!function_exists('userInfo')) {
    /**
     * 获取登录用户信息
     * @return string
     */
    function userInfo()
    {
        return session('user');
    }

}
