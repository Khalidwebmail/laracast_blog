<?php

namespace App\Traits;

trait RecordActivity
{

    protected static function bootRecordActivity()
    {
        if(auth()->guest())
        {
            return;
        }

        foreach(static::getActivityToRecord() as $event)
        {
            static::$event(function($model) use ($event) {
                $model->recordActivity($event);
            });
        }
        // static::created(function ($thread) {
        //     $thread->recordActivity('created');
        // });
    }

    protected static function getActivityToRecord()
    {
        return ['created'];
    }

    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id'       => auth()->id(),
            'type'          => $this->getActivityType($event),
        ]);
        // Activity::create([
        //     'user_id'       => auth()->id(),
        //     'type'          => $this->getActivityType($event),
        //     'subject_id'    => $this->id,
        //     'subject_type'  =>  get_class($this)
        // ]);
    }

    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }

    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }
}