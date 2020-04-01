@extends('layouts.app')

@section('content')
<div class="MainSection-reset-password container">
    <div class="row justify-content-center">
        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="MainSection-reset-password-form">
                <h1 class="MainSection-reset-password--title">{{ __('Resetowanie Hasła') }}</h1>

                @csrf

                <div class="MainSection-reset-password-controls">
                    <input id="email" type="email" class="MainSection-reset-password-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-login-page full-color">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
