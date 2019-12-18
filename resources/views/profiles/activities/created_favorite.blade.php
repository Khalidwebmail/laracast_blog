@component("profiles.activities.activities")
    @slot('heading')
        <a href="{{ $activity->subject->favorited->path() }}">
            {{ $profile_user->name }} favorited a reply
        </a>
        {{-- <a href="{{ $activity->subject->thread->path() }}">{{ $activity->subject->thread->title }}</a> --}}
    @endslot

    @slot('body')
        {{ $activity->subject->favorited->body }}
    @endslot
@endcomponent