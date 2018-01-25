<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public $timestamps = false;

    /**
     * 获取好友
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'f_id');
    }
}
