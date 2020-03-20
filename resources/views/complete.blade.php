@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Dziękujemy za złożenie zamówienia</h2>
            </div>
            <div class="col-md-12">
                <p>Aby dokończyć zamówienie pobierz umowę</p>
                <p><a class="btn btn-primary" href="{{ route('create_pdf', ['order'=>$order->id]) }}">Umowa do
                        pobrania</a>
                </p>
            </div>
        </div>
    </div>

@endsection

