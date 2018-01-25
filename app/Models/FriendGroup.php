<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendGroup extends Model
{

    /**
     * 获取分组下的好友
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function friends()
    {
        return $this->hasMany(Friend::class,'friend_group_id','id');
    }

}
