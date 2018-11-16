@extends('layouts.app')

@section('content')

    <div class="columns">
        <div class="column is-one-third is-offset-one-third m-t-50">
            <div class="panel">
                <p class="panel-heading">{{__('Login')}}</p>
                <div class="panel-block">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                        <div class="field">
                        <label for="email" class="label">{{ __('Email') }}</label>
                        <p class="control">
                            <input id="email" type="text" name="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" placeholder="name@app.cm" autofocus required>
                        </p>

                        @if ($errors->has('email'))
                            <p class="help is-danger" role="alert">{{ $errors->first('email') }}</p>
                        @endif

                    </div>

                    <div class="field">
                        <label for="password" class="label">Password</label>
                        <p class="control">
                            <input type="password" name="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" id="password">
                        </p>

                        @if ($errors->has('password'))
                            <p class="help is-danger" role="alert">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="field">
                        <b-checkbox name="remember">Remenber me</b-checkbox>
                    </div>

                    <div class="field is-grouped">

                        <div class="control">
                            <button class="button is-link">{{ __('Login') }}</button>
                        </div>
                        <div class="control">
                            <a class="button is-text" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
