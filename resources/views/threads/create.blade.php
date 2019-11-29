@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        Create new thread
                    </h4>
                </div>

                <div class="panel-body">
                    <form action="/threads/store" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label for="channel">Select Channel</label>
                            <select name="channel_id" id="channel_id" class="form-control">
                                <option value="0">Select</option>
                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ ucfirst($channel->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" class="form-control" rows="8" value="{{ old('body') }}"></textarea>
                        </div>

                        <input type="submit" class="btn btn-default" value="Save">
                    </form>

                    @if(count($errors))
                        @foreach($errors->all() as $error)
                            <ul class="alert alert-danger">{{ $error }}</ul>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
