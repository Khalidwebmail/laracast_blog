<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $guarded = [];
    
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function($builder) {
            $builder->withCount('replies');
        });
    }

    public function path()
    {
        return '/threads/'.$this->channel->slug.'/'.$this->id;
        // return "/threads/{$this->channel->slug}/{$this->id}";
    }

    /**
     * replies function
     *
     * @return reply list of replies of threads
     */
    public function replies()
    {
        // return $this->hasMany(Reply::class);
        return $this->hasMany(Reply::class)->withCount('favourites');
    }

    // public function replyCount()
    // {
    //     return $this->replies()->count();
    // }

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

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
