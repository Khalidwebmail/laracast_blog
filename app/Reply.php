<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    /**
     * ownder function
     *
     * @return username who give comment in therad
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
