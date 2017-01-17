@extends('admin.layout')

@section('content')
    <h1>Edit post</h1>
    <p>
        <a href="{{ route('admin.posts.index') }}">< Back to the list</a>
    </p>

    @include('admin.posts.form')
@endsection