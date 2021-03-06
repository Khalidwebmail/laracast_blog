@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="level">
                        <span class="flex">
                            <a href="{{ route('profile',$thread->creator) }}">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}
                        </span>
                        @can('update', $thread)
                            <form action="{{ $thread->path() }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field("DELETE") }}

                                <button type="submit" class="btn btn-link">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
                <div class="panel-body">
                    {{ $thread->body }}
                </div>
            </div>
            {{-- @php
                $replies = $thread->replies()->paginate(2)
            @endphp --}}

            @foreach($replies as $reply)
                @include('threads.partial.reply')
            @endforeach

            {{ $replies->links() }}

            @if(auth()->check())
                <form action="{{ $thread->path() . '/replies' }}" method="POST">
                    {{ csrf_field() }}
                    <label for="body">Body</label>
                    <textarea name="body" id="body" rows="5" class="form-control"></textarea>
                    <input style="margin-top: 10px;" class="btn btn-primary" type="submit" name="submit" value="Post">
                </form>
            @else
                <p align="center">Please login to comment</p>
            @endif
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans() }}
                        by <a href="#">{{ $thread->creator->name }}</a> and currently has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
