<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageBox extends Model
{
    protected $table = 'message_box';

    public function fromDateTime($value)
    {
        return strtotime(parent::fromDateTime($value));
    }

    /**
     * 发送者
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fromUser()
    {
        return $this->hasOne(User::class, 'id', 'f_id');
    }
}
