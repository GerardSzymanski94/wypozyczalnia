@extends('layouts.app')

@section('content')
    <form>
        <div class="MainSection-alerts container">
            <div class="row justify-content-center" id="added_to_cart" style="display: none;">
                <div class="col-12">
                    <div class="MainSection-alerts-alert alert-success">
                        Dodano do koszyka
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" id="check_amount" style="display: none;">
                <div class="col-12">
                    <div class="MainSection-alerts-alert alert-danger">
                        Dodałeś do koszyka więcej produktów niż jest dostępny. Sprawdź dostępność i dodaj je ponownie
                    </div>
                </div>
            </div>
        </div>

        @csrf

        <section class="MainSection-hero">
            <div class="container px-0 px-sm-3">
                <div class="MainSection-hero-image" style="background-image: url('{{ asset('images/slider1.jpg') }}')">
                    <div class="MainSection-hero-overlay">
                        <div class="MainSection-hero-text">
                            <h1 class="MainSection-hero-text--title">Dla firm i osób prywatnych</h1>
                            <p class="MainSection-hero-text--description">Zawsze nowe modele elektrostymulatorów od Compex. Dzięki nim przyspieszamy regenerację, wzmacniamy mięśnie i przygotowujemy cały organizm na duży wysiłek fizyczny.</p>
                            <a href="#" class="MainSection-hero-text--button">
                                <i class="MainSection-hero-text--icon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="MainSection-hero-text--svg"><title>arrow-right</title><path d="M11.293 5.707l5.293 5.293h-11.586c-0.552 0-1 0.448-1 1s0.448 1 1 1h11.586l-5.293 5.293c-0.391 0.391-0.391 1.024 0 1.414s1.024 0.391 1.414 0l7-7c0.092-0.092 0.166-0.202 0.217-0.324 0.101-0.245 0.101-0.521 0-0.766-0.049-0.118-0.121-0.228-0.217-0.324l-7-7c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414z"></path></svg>
                                </i>
                                <span>Dowiedź się więcej</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="MainSection-Items">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="MainSection-Items-description">
                            <h2 class="MainSection-Items--title">Wybierz produkt</h2>
                            <p>Najedź na produkt i kliknij, aby wybrać urządzenie do wypożyczania.</p>
                        </div>
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-12 col-md-4 col-xl-3">
                                    <label class="MainSection-Items-box product_card" for="product_{{ $product->id }}" data-id="{{ $product->id }}">
                                        <div id="{{ $product->id }}" class="card">
                                            <div class="MainSection-Items-wrapper">
                                                <img src="{{ asset('storage/'. $product->getMainPhoto->url) }}" class="MainSection-Items--image" alt="{{ $product->name }}">
                                                <div class="MainSection-Items-wrapper-description">
                                                    <h5 class="MainSection-Items-wrapper-description--title">{{ $product->name }}</h5>
                                                    <p class="MainSection-Items-wrapper-description--text">Dostępna ilość: {{ $product->amount }}</p>
                                                </div>

                                                <div class="MainSection-Items-collapse collapse fade multi-collapse" id="multiCollapse-{{ $product->id }}">
                                                    <ul class="MainSection-Items-wrapper-group">
                                                        <li class="MainSection-Items-wrapper-group--list">7 dni - {{ $product->price_one_week }}zł /
                                                            dzień
                                                        </li>
                                                        <li class="MainSection-Items-wrapper-group--list">14 dni - {{ $product->price_two_week }}zł /
                                                            dzień
                                                        </li>
                                                        <li class="MainSection-Items-wrapper-group--list">21 dni - {{ $product->price_three_week }}zł
                                                            /
                                                            dzień
                                                        </li>
                                                        <li class="MainSection-Items-wrapper-group--list">28 dni - {{ $product->price_four_week }}zł /
                                                            dzień
                                                        </li>
                                                        <li class="MainSection-Items-wrapper-group--list">>28 dni - {{ $product->price_more_month }}zł
                                                            /
                                                            dzień
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>

                                            <button class="btn btn-product" type="button" data-toggle="collapse" data-target="#multiCollapse-{{ $product->id }}" aria-expanded="false" aria-controls="multiCollapse-{{ $product->id }}">Cennik dla tego modelu</button>
                                        </div>
                                    </label>
                                </div>
                                <input type="checkbox" name="product[{{ $product->id }}]" class="product_checkbox" value="{{ $product->id }}" style="display: none;" id="product_{{ $product->id }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="MainSection-countItems">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h2>Ilość urządzeń</h2>
                            <label for="amount">Ilość urządzeń<span class="required">*</span></label>
                            <input type="number" name="amount" id="amount" class="form-control" step="1" value="1">

                            @if($errors->has('amount'))
                                <p class="alert alert-danger">
                                    {{ $errors->first('amount') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <h2>Wybierz liczbę dni</h2>

                            <label for="days">Liczba dni <span class="required">*</span></label>
                            <input type="number" name="days" id="days" class="form-control" step="1" value="1">

                            @if($errors->has('days'))
                                <p class="alert alert-danger"> {{ $errors->first('days') }} </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        </section>

        <section class="MainSection-Items">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="MainSection-Items-description">
                            <h2 class="MainSection-Items--title">Wybierz Dodatek</h2>
                            <p>Najedź na produkt i kliknij, aby wybrać dodatek do wypożyczania.</p>
                        </div>
                        <div class="row">
                            @foreach($additionals as $additional)
                                <div class="col-12 col-md-4 col-xl-3">
                                    <label class="MainSection-Items-box additional_card" for="additional_{{ $additional->id }}" data-id="{{ $additional->id }}">
                                        <div id="{{ $additional->id }}" class="card">
                                            <div class="MainSection-Items-wrapper">
                                                <img src="{{ asset('storage/'. $additional->getMainPhoto->url) }}" class="MainSection-Items--image" alt="{{ $additional->name }}">

                                                <div class="MainSection-Items-wrapper-description">
                                                    <h5 class="MainSection-Items-wrapper-description--title">{{ $additional->name }}</h5>
                                                    <p class="MainSection-Items-wrapper-description--text">
                                                        Dostępna ilość: {{ $additional->amount }}
                                                    </p>
                                                </div>

                                                <hr/>

                                                <ul class="MainSection-Items-wrapper-group">
                                                    <li class="MainSection-Items-wrapper-group--list">
                                                        {{ $additional->price_one_week }} zł
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </label>
                                    <input type="checkbox" name="additional[{{ $additional->id }}]" class="additional_checkbox" style="display: none;" id="additional_{{ $additional->id }}" value="{{ $additional->id }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="MainSection-countItems">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h2>Ilość zestawów elektrod</h2>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="amount_additional">Ilość zestawów elektrod<span class="required">*</span></label>
                                <input type="number" name="amount_additional" id="amount_additional" class="form-control" step="1" value="1">

                                @if($errors->has('amount_additional'))
                                    <p class="alert alert-danger">
                                        {{ $errors->first('amount_additional') }}
                                    </p>
                                @endif
                            </div>

                            <div class="col-12">
                                <p><span id="price">0</span> zł</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="section_4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        {{--<a href="" class="btn btn-primary">
                            Sprawdź cenę
                        </a>--}}
                        <div class="btn btn-primary" id="add_product">
                            Dodaj do koszyka
                        </div>
                        <a href="{{ route('cart') }}" class="btn btn-primary">
                            Przejdź do koszyka
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection

@section('scripts')
    <script>
        $('body').on('click', '.product_card', function () {
            clearProducts();
            $(this).addClass('checked');
            $("#product_" + $(this).data('id')).is(":checked");
        });

        $('body').on('click', '.btn-product', function() {
            $(this).closest('.product_card').toggleClass('prices');
        });

        $('body').on('click', '.additional_card', function () {
            clearAdditionals();
            $(this).addClass('checked')
            $("#additional_" + $(this).data('id')).is(":checked");
        });

        $('body').on('change', '#days', function () {
            getPrice();
        });

        $('body').on('change', '#amount', function () {
            getPrice();
        });

        $('body').on('change', '#amount_additional', function () {
            getPrice();
        });

        $('body').on('click', '#add_product', function () {
            var product = $(".product_checkbox:checked").val();
            var additional = $(".additional_checkbox:checked").val();
            var days = $("#days").val();
            var amount = $("#amount").val();
            var amount_additional = $("#amount_additional").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'POST',
                url: '{{ route('ajax.add_product') }}',
                data: {
                    product: product,
                    additional: additional,
                    amount_additional: amount_additional,
                    days: days,
                    amount: amount
                },
                success: function (data) {
                    if (data.checkAmount) {
                        $('#check_amount').hide();
                        $('#added_to_cart').show();
                    } else {
                        $('#added_to_cart').hide();
                        $('#check_amount').show();
                    }

                    $('html, body').animate({
                        scrollTop: $("body").offset().top
                    }, '250');

                    clearProducts();
                    clearAdditionals();
                    $('#days').val(0);
                },
                error:
                    function (jqXHR, textStatus, errorThrown) {
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
            });

        });

        function clearProducts() {
            $('.product_checkbox').prop("checked", false);
            $('.product_card').each(function () {
                $(this).removeClass('checked')
            });
        }

        function clearAdditionals() {
            $('.additional_card').each(function () {
                $(this).removeClass('checked')
            });
            $('.additional_checkbox').prop("checked", false);
        }

        $('body').on('change', '.product_checkbox', function () {
            getPrice();
        });

        $('body').on('change', '.additional_checkbox', function () {
            getPrice();
        });

        function getPrice() {
            var product = $(".product_checkbox:checked").val();
            var additional = $(".additional_checkbox:checked").val();
            var days = $("#days").val();
            var amount = $("#amount").val();
            var amount_additional = $("#amount_additional").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'POST',
                url: '{{ route('ajax.get_price') }}',
                data: {
                    product: product,
                    additional: additional,
                    amount_additional: amount_additional,
                    days: days,
                    amount: amount
                },
                success: function (data) {
                    $('#price').empty().append(data.price);
                },
                error:
                    function (jqXHR, textStatus, errorThrown) {
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
            });
        }
    </script>
@endsection
