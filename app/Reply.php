<?php

namespace App;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use RecordActivity;
    
    protected $guarded = [];

    protected $with = ['favourites', 'owner'];
    /**
     * ownder function
     *
     * @return username who give comment in therad
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favourite');
    }

    public function favourite()
    {
        $attributes = ['user_id' => auth()->id()];
        if(! $this->favourites()->where($attributes)->exists())
        {
            return $this->favourites()->create($attributes);
        }
    }

    public function isFavorited()
    {
        return !! $this->favourites()->where('user_id', auth()->id())->exists();
    }

    public function getFavoriteCountAttribute()
    {
        return $this->favourites->count();
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
