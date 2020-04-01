@extends('layouts.app')

@section('content')
<div class="MainSection-register container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{ route('register') }}" class="MainSection-register-form">
                <h1 class="MainSection-register--title">{{ __('Rejestracja') }}</h1>

                @csrf

                <div class="MainSection-register-controls">
                    <input id="name" type="text" class="MainSection-register-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="{{ __('Name') }}" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="email" type="email" class="MainSection-register-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password" type="password" class="MainSection-register-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password-confirm" type="password" class="MainSection-register-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                </div>

                <button type="submit" class="btn btn-login-page full-color">
                    {{ __('Register') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
