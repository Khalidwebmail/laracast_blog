@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Posted By: <a href="#">{{ $thread->creator->name }}</a>
                    <h4>
                        {{ $thread->title }}
                    </h4>
                </div>

                <div class="panel-body">
                    {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($thread->replies as $reply)
                @include('threads.partial.reply')
            @endforeach
        </div>
    </div>
</div>
@endsection
