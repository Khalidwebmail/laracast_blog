@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>
                        {{ $profile_user->name }}
                        <small>since {{ $profile_user->created_at->diffForHumans() }}</small>
                    </h1>
                </div>
                {{-- @foreach($threads as $thread) --}}
                @foreach($activities as $date => $activity)
                    @foreach($activity as $record)
                        @include("profiles.activities.$record->type", ['activity' => $record])
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
