@extends('layouts.app')

@section('content')
    <section class="MainSection-thankyou container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="MainSection-thankyou-wrapper">
                    <h2 class="MainSection-thankyou-wrapper--title">Dziękujemy za złożenie zamówienia</h2>
                    <a href="{{ route('user.orders') }}" class="btn btn-ending full-color">Zobacz zamówienie</a>
                    <a href="{{ url('/') }}" class="btn btn-ending">Powrót na stronę główną</a>
                </div>
            </div>
        </div>
    </section>
@endsection

