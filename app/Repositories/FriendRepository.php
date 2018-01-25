<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/1/25
 * Time: 上午9:39
 */

namespace App\Repositories;


use App\Models\Friend;

class FriendRepository extends BaseRepository
{
    public function friends($u_id)
    {
        return Friend::with(['friends','groups'])->where('u_id', $u_id)->get();
    }
}