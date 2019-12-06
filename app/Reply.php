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
        return $this->favourites()->where('user_id', auth()->id())->exists();
    }
}
