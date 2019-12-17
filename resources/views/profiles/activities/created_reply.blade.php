@component("profiles.activities.activities")
    @slot('heading')
        {{ $profile_user->name }} reply to 
        <a href="{{ $activity->subject->thread->path() }}">{{ $activity->subject->thread->title }}</a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent