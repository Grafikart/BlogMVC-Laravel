@extends('layout')

@section('content')
    <form class="form-signin" role="form" method="POST" action="{{ url('/login') }}">

        <h4 class="form-signin-heading">Please sign in</h4>
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="name" class="col-md-4 control-label">Username</label>
            <div class="col-md-6">
                <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
            <label for="password" class="col-md-4 control-label">Password</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Sign in
                </button>
            </div>
        </div>
    </form>
@endsection
