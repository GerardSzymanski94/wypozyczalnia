@extends('layouts.app')

@section('content')
    <section class="MainSection-thankyou container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="MainSection-thankyou-wrapper">
                    <h2 class="MainSection-thankyou-wrapper--title">Dziękujemy za złożenie zamówienia</h2>
                    {{--<p class="MainSection-thankyou-wrapper--text">Aby dokończyć musisz akceptować regulamin</p>--}}
                    {{-- <a class="btn btn-ending full-color" href="{{ route('create_pdf', ['order'=>$order->id]) }}">
                         <span>Umowa do pobrania</span>
                     </a>--}}

                </div>
            </div>
        </div>
    </section>
@endsection

