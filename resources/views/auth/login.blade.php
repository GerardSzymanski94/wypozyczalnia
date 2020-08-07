@extends('layouts.app')

@section('content')
<section class="MainSection-login container">
    <div class="row justify-content-center">
        <div class="col-12">
            <form method="POST" action="{{ route('login') }}" class="MainSection-login-form">

                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <h1 class="MainSection-login--title">{{ __('Zaloguj się do wypoyżczalni') }}</h1>

                        <div class="MainSection-login-controls">
                            <input id="email" type="email" class="MainSection-login-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input id="password" type="password" class="MainSection-login-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Hasło">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="MainSection-login-additionals">

                            <label class="MainSection-login-additionals-remember" for="remember">
                                <input class="MainSection-login-additionals-remember--checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Zapamiętaj mnie</span>
                            </label>


                            @if (Route::has('password.request'))
                                <a class="btn MainSection-login-additionals-remember" href="{{ route('password.request') }}">
                                    <span>Przypomnij hasło</span>
                                </a>
                            @endif
                        </div>

                        <div class="MainSection-login-buttons">
                            <button type="submit" class="btn btn-login-page full-color">
                                Zaloguj
                            </button>
                            <a class="btn btn-login-page" href="{{ route('register') }}">Załóż konto</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection
