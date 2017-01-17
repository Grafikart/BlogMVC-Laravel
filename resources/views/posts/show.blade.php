@extends('sidebar')

@section('title', $post->name)

@section('main')

    <h1>{{ $post->name }}</h1>
    <p>
        <small>
            Category : <a href="{{ route('posts.category', ['slug' => $post->category->slug]) }}">{{ $post->category->name }}</a>
            by <a href="{{ route('posts.user', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a>
            on {{ $post->created_at->format('M dS Y') }}
        </small>
    </p>

    {!! $post->html !!}

    <p>&nbsp;</p><!-- I know.... -->

    <h3>Comment this post</h3>
    {{ Form::model($comment, ['route' => 'comments.store']) }}
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group @if($errors->first('username')) has-danger @endif">
                    {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Username']) !!}
                    @if($errors->first('username'))
                        <small class="form-control-feedback">{{ $errors->first('username') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group @if($errors->first('email')) has-danger @endif">
                    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Email']) !!}
                    @if($errors->first('email'))
                        <small class="form-control-feedback">{{ $errors->first('email') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group @if($errors->first('content')) has-danger @endif">
            {!! Form::textarea('content', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Content']) !!}
            @if($errors->first('content'))
                <small class="form-control-feedback">{{ $errors->first('content') }}</small>
            @endif
        </div>
        {!! Form::hidden('post_id') !!}
        {!! Form::submit('Comment', ['class' => 'btn btn-primary']) !!}

    {{ Form::close() }}

    <p>&nbsp;</p>

    <h3>{{ count($post->comments) }} Comment{{ count($post->comments) > 1 ? 's' : '' }}</h3>

    @foreach($post->comments as $comment)
    <div class="row">
        <div class="col-md-2">
            <img src="{{ $comment->gravatar }}" width="100%">
        </div>
        <div class="col-md-10">
            <p><strong>{{ $comment->username }}</strong> {{ $comment->created_at->diffForHumans() }}</p>
            <p>{{ $comment->content }}</p>
        </div>
    </div>
    <hr>
    @endforeach

@endsection
