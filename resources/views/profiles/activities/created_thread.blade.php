@component("profiles.activities.activities")
    @slot('heading')
        {{ $profile_user->name }} published 
        <a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent