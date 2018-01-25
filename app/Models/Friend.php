<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public $timestamps = false;

    public function friends()
    {
        return $this->hasMany(User::class, 'id', 'f_id');
    }
}
