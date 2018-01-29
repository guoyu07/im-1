<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/1/23
 * Time: 上午9:33
 */

namespace App\Repositories;


use App\Models\FriendGroup;
use App\Models\User;

class UserRepository extends BaseRepository
{

    /**
     * 查询用户的好友分组
     * @param $u_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function friends($u_id)
    {
        return User::with(['friendGroups' => function ($query) {
            $query->with(['friends' => function ($query) {
                $query->with(['users'])->get();
            }])->get();
        }])->where('id', $u_id)->first();

    }
}