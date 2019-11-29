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

    @if(auth()->check())
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="{{ $thread->path() . '/replies' }}" method="POST">
                {{ csrf_field() }}
                <label for="body">Body</label>
                <textarea name="body" id="body" rows="5" class="form-control"></textarea>
                <input style="margin-top: 10px;" class="btn btn-primary" type="submit" name="submit" value="Post">
            </form>
        </div>
    </div>
    @else
        <p align="center">Please login to comment</p>
    @endif
</div>
@endsection
