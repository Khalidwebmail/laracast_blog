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

    /**
     * creator function
     *
     * @return user name who write the thread void
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * addReply function
     *
     * @param [type] $reply
     * @return void
     */
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
}
