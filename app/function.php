<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/1/23
 * Time: 上午9:30
 */

if (!function_exists('userId')) {
    /**
     * 获取登录用户id
     * @return string
     */
    function userId()
    {
        return session('user')->id;
    }

}