@extends('auth.layout')

@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
    {{ csrf_field() }}

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="msg"><p class="lead text-center">Reset Password</p></div>


    <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="control-label">E-Mail Address</label>

        <div class="form-line">
            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ $email or old('email') }}" required autofocus>

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div>


    <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="control-label">Password</label>

        <div class="form-line">
            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="input-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password-confirm" class="control-label">Confirm Password</label>
        <div class="form-line">
            <input id="password-confirm" placeholder="Password" type="password" class="form-control" name="password_confirmation" required>

            @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="input-group">
        <div class="col-md-6 col-md-offset-3">
            <button type="submit" class="btn btn-primary  waves-effect">
                Reset Password
            </button>
        </div>
    </div>

    <div class="row m-t-15 m-b--20">
                      <!--   <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div> -->
                        <div class="col-xs-12 align-right">
                            <a href="{{ url('login') }}">Go to Login</a>
                        </div>
                    </div>
                </form>
                @endsection