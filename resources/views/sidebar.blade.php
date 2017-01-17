@extends('layout')

@section('content')
    <div class="row">
        <div class="col-sm-8">
            @yield('main')
        </div>
        <div class="col-sm-4">
            @include('partials.sidebar')
        </div>
    </div>
@endsection