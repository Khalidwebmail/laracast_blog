<?php

namespace App;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    use RecordActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function($builder) {
            $builder->withCount('replies');
        });

        static::deleting(function($thread) {
            $thread->replies->each->delete();
            // $thread->replies->each(function($reply) {
            //     $reply->delete();
            // });
        });

        // static::deleting(function($thread) {
        //     $thread->replies()->delete();
        // })

        // static::created(function ($thread) {
        //     $thread->recordActivity('created');
        // });
    }

    // protected function recordActivity($event)
    // {
    //     Activity::create([
    //         'user_id'       => auth()->id(),
    //         'type'          => $this->getActivityType($event),
    //         'subject_id'    => $this->id,
    //         'subject_type'  =>  get_class($this)
    //     ]);
    // }

    // protected function getActivityType($event)
    // {
    //     return $event . '_' . strtolower((new ReflectionClass($this))->getShortName());
    // }

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
