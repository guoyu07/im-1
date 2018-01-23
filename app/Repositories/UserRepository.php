<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/1/23
 * Time: 上午9:33
 */

namespace App\Repositories;


class UserRepository extends BaseRepository
{
    public function login(){
        return $this->find(1);
    }
}