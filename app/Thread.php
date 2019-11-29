<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $guarded = [];
    
    public function path()
    {
        return '/threads/'.$this->id;
    }

    /**
     * replies function
     *
     * @return reply list of replies of threads
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
