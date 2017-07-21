@extends('auth.layout')

@section('content')
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
            <div class="msg"><p class="lead text-center">Forgot Password</p></div>


            <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail</label>

                <div class="form-line">
                    <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 m-t-15 ">
                    <p class="help-block"> We'll send you an email with your username and a link to reset your password.</p>
                </div>
                <div class="col-xs-10 col-xs-offset-1">
                    <button class="btn btn-block bg-green waves-effect" type="submit">Send Password Reset Link</button>
                </div>
            </div>
            <div class="row m-t-15 m-b--20">
                <div class="col-xs-12 align-right">
                    <a href="{{ url('login') }}">Remembered Password? Login here</a>
                </div>
            </div>
        </form>
@endsection