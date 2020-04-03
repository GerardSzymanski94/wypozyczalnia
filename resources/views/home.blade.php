@extends('layouts.app')

@section('content')
    <form id='form'>
        <div class="MainSection-alerts container">
            <div class="row justify-content-center check_alert" id="added_to_cart" style="display: none;">
                <div class="col-md-12">
                    <div class="MainSection-alerts-alert alert-success">
                        <span>Dodano do koszyka</span>
                        <button class="MainSection-alerts-close">
                            <i class="fa fa-times MainSection-alerts-icon"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center check_alert" id="check_input_product" style="display: none;">
                <div class="col-md-12">
                    <div class="MainSection-alerts-alert alert-danger">
                        <span>Nie wybrałeś żadnego produktu</span>
                        <button class="MainSection-alerts-close">
                            <i class="fa fa-times MainSection-alerts-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center check_alert" id="check_amount" style="display: none;">
                <div class="col-md-12">
                    <div class="MainSection-alerts-alert alert-danger">
                        <span>Dodałeś do koszyka więcej produktów niż jest dostępny. Sprawdź dostępność i dodaj je ponownie</span>
                        <button class="MainSection-alerts-close">
                            <i class="fa fa-times MainSection-alerts-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center check_alert" id="check_input_days" style="display: none;">
                <div class="col-md-12">
                    <div class="MainSection-alerts-alert alert-danger">
                        <span>Podano nieprawidłową liczbę dni</span>
                        <button class="MainSection-alerts-close">
                            <i class="fa fa-times MainSection-alerts-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center check_alert" id="check_amount_additional" style="display: none;">
                <div class="col-md-12">
                    <div class="MainSection-alerts-alert alert-danger">
                        <span>Dodałeś do koszyka więcej elektrod niż jest dostępnych. Sprawdź dostępność i dodaj je ponownie</span>
                        <button class="MainSection-alerts-close">
                            <i class="fa fa-times MainSection-alerts-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center check_alert" id="check_input_amount" style="display: none;">
                <div class="col-md-12">
                    <div class="MainSection-alerts-alert alert-danger">
                        <span>Nie wybrałeś żadnego produktu</span>
                        <button class="MainSection-alerts-close">
                            <i class="fa fa-times MainSection-alerts-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center check_alert" id="check_input_amount_additional"
                 style="display: none;">
                <div class="col-md-12">
                    <div class="MainSection-alerts-alert alert-danger">
                        <span>Niepoprawna liczba ilości elektrod</span>
                        <button class="MainSection-alerts-close">
                            <i class="fa fa-times MainSection-alerts-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @csrf

        <section class="MainSection-hero">
            <div class="container px-0 px-md-3">
                <div class="MainSection-hero-image" style="background-image: url('{{ asset('images/slider1.jpg') }}')">
                    <div class="MainSection-hero-overlay">
                        <div class="MainSection-hero-text">
                            <h1 class="MainSection-hero-text--title">Dla firm i osób prywatnych</h1>
                            <p class="MainSection-hero-text--description">Zawsze nowe modele elektrostymulatorów od
                                Compex. Dzięki nim przyspieszamy regenerację, wzmacniamy mięśnie i przygotowujemy cały
                                organizm na duży wysiłek fizyczny.</p>
                            <a href="#" class="MainSection-hero-text--button">
                                <i class="MainSection-hero-text--icon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" class="MainSection-hero-text--svg"><title>
                                            arrow-right</title>
                                        <path d="M11.293 5.707l5.293 5.293h-11.586c-0.552 0-1 0.448-1 1s0.448 1 1 1h11.586l-5.293 5.293c-0.391 0.391-0.391 1.024 0 1.414s1.024 0.391 1.414 0l7-7c0.092-0.092 0.166-0.202 0.217-0.324 0.101-0.245 0.101-0.521 0-0.766-0.049-0.118-0.121-0.228-0.217-0.324l-7-7c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414z"></path>
                                    </svg>
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
                            <h2 class="MainSection-Items--title">Wybierz i zaznacz urządzenie, które chcesz wypożyczyć</h2>
                            <p  class="MainSection-Items--text">Aby wybrać urządzenie - najedź i kliknij na produkt. Ceny wypożyczania możesz sprawdzić klikając w przycisk "Cennik dla tego modelu".</p>
                        </div>
                        <div class="@if (count($products) <= 8) single-column @else two-column @endif swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($products as $product)
                                    <div class="swiper-slide">
                                        <label class="MainSection-Items-box product_card @if($product->amount==0) sold-out @endif" for="product_{{ $product->id }}"
                                            data-id="{{ $product->id }}">
                                            <div id="{{ $product->id }}" class="MainSection-Items--box-height">
                                                <div class="MainSection-Items-wrapper">
                                                    <img src="{{ asset('storage/'. $product->getMainPhoto->url) }}"
                                                        class="MainSection-Items--image" alt="{{ $product->name }}">
                                                    <div class="MainSection-Items-wrapper-description">
                                                        <h5 class="MainSection-Items-wrapper-description--title">{{ $product->name }}</h5>
                                                        <p class="MainSection-Items-wrapper-description--text">Dostępna
                                                            ilość: {{ $product->amount }}</p>
                                                    </div>

                                                    <div class="MainSection-Items-collapse collapse fade multi-collapse"
                                                        id="multiCollapse-{{ $product->id }}">
                                                        <ul class="MainSection-Items-wrapper-group-list">
                                                            <li class="MainSection-Items-wrapper-group--list">7 dni
                                                                - {{ $product->price_one_week }}zł /
                                                                dzień
                                                            </li>
                                                            <li class="MainSection-Items-wrapper-group--list">14 dni
                                                                - {{ $product->price_two_week }}zł /
                                                                dzień
                                                            </li>
                                                            <li class="MainSection-Items-wrapper-group--list">21 dni
                                                                - {{ $product->price_three_week }}zł
                                                                /
                                                                dzień
                                                            </li>
                                                            <li class="MainSection-Items-wrapper-group--list">28 dni
                                                                - {{ $product->price_four_week }}zł /
                                                                dzień
                                                            </li>
                                                            <li class="MainSection-Items-wrapper-group--list">>28 dni
                                                                - {{ $product->price_more_month }}zł
                                                                /
                                                                dzień
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <button class="btn btn-product MainSection-Items-wrapper-group--button" type="button" data-toggle="collapse"
                                                        data-target="#multiCollapse-{{ $product->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="multiCollapse-{{ $product->id }}">Cennik dla tego modelu
                                                    </button>
                                                </div>
                                            </div>
                                        </label>

                                        <input type="radio" name="product" class="product_checkbox"
                                            value="{{ $product->id }}" style="display: none;"
                                            id="product_{{ $product->id }}" @if($product->amount==0) disabled @endif />
                                    </div>
                                @endforeach
                            </div>

                            <div class="swiper-button-prev">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-left" class="swiper-button-prev-icon svg-inline--fa fa-angle-left fa-w-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z"></path></svg>
                            </div>
                            <div class="swiper-button-next">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" class="swiper-button-prev-icon svg-inline--fa fa-angle-right fa-w-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="MainSection-countItems container">
            <div class="MainSection-countItems-background"
                 style="background-image: url('{{ asset('images/wypozyczalnia-rehastore-compex.jpg') }}');">
                <div class="row justify-content-center">
                    <div class="MainSection-countItems-group">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4 mb-md-0">
                                <div class="MainSection-countItems-group-wrapper">
                                   <div class="MainSection-countItems-group-wrapper-space">
                                        <h3 class="MainSection-countItems--title">Ilość urządzeń</h3>
                                        <label class="MainSection-countItems--amount" for="amount">Ilość urządzeń
                                            <span class="required">*</span>
                                        </label>
                                   </div>

                                    <input class="MainSection-countItems--number" type="number" name="amount" id="amount"
                                    step="1" value="1" min="1">
                                </div>

                                @if($errors->has('amount'))
                                    <p class="alert alert-danger">
                                        {{ $errors->first('amount') }}
                                    </p>
                                @endif
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="MainSection-countItems-group-wrapper">
                                    <div class="MainSection-countItems-group-wrapper-space">
                                        <h3 class="MainSection-countItems--title">Wybierz liczbę dni na jaką chcesz wypożyczyć urządzenie</h3>
                                        <label class="MainSection-countItems--amount" for="days">Liczba dni wypożyczenia
                                            <span class="required">*</span>
                                        </label>
                                    </div>
                                    <input class="MainSection-countItems--number form-control" type="number"
                                    name="days" id="days" step="1" value="1" min="1">
                                </div>

                                @if($errors->has('days'))
                                    <p class="alert alert-danger"> {{ $errors->first('days') }} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="MainSection-Items">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="MainSection-Items-description">
                            <h2 class="MainSection-Items--title">Do korzystania z elektrostymulatora konieczne są elektrody. Można także skorzystać z dodatkówych akcesoriów. Akcesoria i elektrody możesz kupić w tym kroku. Przygotowaliśmy take zestawy elektrod pod konkretne potrzeby.</h2>
                            <p  class="MainSection-Items--text">Zaznacz produkty, które chcesz dobrać do wypożyczonego urządzenia.</p>
                        </div>
                        <div class="@if (count($additionals) <= 8) single-column @else two-column @endif swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($additionals as $additional)
                                    <div class="swiper-slide">
                                        <label class="MainSection-Items-box additional_card @if($additional->amount==0) sold-out @endif"
                                            for="additional_{{ $additional->id }}" data-id="{{ $additional->id }}">
                                            <div id="{{ $additional->id }}" class="MainSection-Items--box-height">
                                                <div class="MainSection-Items-wrapper">
                                                    <img src="{{ asset('storage/'. $additional->getMainPhoto->url) }}"
                                                        class="MainSection-Items--image" alt="{{ $additional->name }}">

                                                    <div class="MainSection-Items-wrapper-description">
                                                        <h5 class="MainSection-Items-wrapper-description--title">{{ $additional->name }}</h5>
                                                        <p class="MainSection-Items-wrapper-description--text">
                                                            Dostępna ilość: {{ $additional->amount }}
                                                        </p>
                                                    </div>

                                                    <ul class="MainSection-Items-wrapper-group">
                                                        <li class="MainSection-Items-wrapper-group--list">
                                                            {{ $additional->price_one_week }} zł
                                                        </li>
                                                        <li>
                                                            <label class="MainSection-Items-wrapper-group--label">
                                                                <span>Ilość:</span>
                                                                <input class="MainSection-Items-wrapper-group--countItems-number" type="number"
                                                                    name="amount_additional[{{ $additional->id }}]" id="amount_additional"
                                                                    class="form-control" step="1" value="1" min="1">
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </label>
                                        <input type="checkbox" name="additional[{{ $additional->id }}]"
                                            class="additional_checkbox" style="display: none;"
                                            id="additional_{{ $additional->id }}" value="{{ $additional->id }}"
                                            @if($additional->amount==0) disabled @endif />
                                    </div>
                                @endforeach
                            </div>

                            <div class="swiper-button-prev">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-left" class="swiper-button-prev-icon svg-inline--fa fa-angle-left fa-w-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z"></path></svg>
                            </div>
                            <div class="swiper-button-next">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" class="swiper-button-prev-icon svg-inline--fa fa-angle-right fa-w-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="MainSection-finish-price">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="MainSection-finish-price-wrapper">
                            <h2 class="MainSection-finish-price--title">Podsumowanie kosztu wypożyczenia</h2>
                            <p class="MainSection-finish-price--price">Do zapłaty: <span id="price">0</span> zł</p>
                            <div class="MainSection-finish-price-buttons">
                                <button class="btn btn-ending full-color" id="add_product">
                                    Dodaj do koszyka
                                </button>
                                <a href="{{ route('cart') }}" class="btn btn-ending">
                                    Przejdź do koszyka
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection

@section('scripts')
    <script>
        $('body').on('change', '.product_checkbox', function () {
            clearProducts();
            $(this).siblings().toggleClass('checked');
            $("#product_" + $(this).data('id')).is(":checked");
        });

        $('body').on('click', '.btn-product', function () {
            $(this).closest('.product_card').toggleClass('prices');
        });

        $('body').on('change', '.additional_checkbox', function () {
            $(this).siblings().toggleClass('checked');
            $("#additional_" + $(this).data('id')).is(":checked");
        });

        $('body').on('change', '#days', function () {
            getPrice();
        });

        $('body').on('change', '#amount', function () {
            getPrice();
        });

        $('body').bind('keyup', '#amount_additional', function () {
            getPrice();
        });

        $('body').on('click', '#add_product', function (e) {
            e.preventDefault();

            /* var product = $(".product_checkbox:checked").val();
             var additional = $(".additional_checkbox:checked").val();
             var days = $("#days").val();
             var amount = $("#amount").val();
             var amount_additional = $("#amount_additional").val();*/

            var form = $("#form").serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'POST',
                url: '{{ route('ajax.add_product') }}',
                data: {
                    form: form
                },
                success: function (data) {
                    $('.check_alert').hide();
                    if (!data.checkAmount) {
                        $('#check_amount').show();
                    }

                    if (!data.inputAmount) {
                        $('#check_input_amount').show();
                    }
                    if (!data.checkAmountAdditional) {
                        $('#check_input_amount_additional').show();
                    }
                    if (!data.inputProducts) {
                        $('#check_input_product').show();
                    }
                    if (!data.inputDays) {
                        $('#check_input_days').show();
                    }
                    if (data.addedToCart) {
                        $('#added_to_cart').show();

                        clearProducts();
                        clearAdditionals();
                        $('#days').val(1);
                    }

                    $('html, body').animate({
                        scrollTop: $("body").offset().top
                    }, '250', () => {
                        $('.MainSection-alerts-close').on( 'click', () => {
                            $('.check_alert').hide();
                        })
                    });
                },
                error:
                    function (jqXHR, textStatus, errorThrown) {
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
            });
        });

        function clearProducts() {
            $('.product_checkbox').removeAttr('checked');
            $('.product_card').each(function () {
                $(this).removeClass('checked')
            });
        }

        function clearAdditionals() {
            $('.additional_card').each(function () {
                $(this).removeClass('checked')
            });
            $('.additional_checkbox').removeAttr('checked');
        }

        $('body').on('change', '.product_checkbox', function () {
            getPrice();
        });

        $('body').on('change', '.additional_checkbox', function () {
            getPrice();
        });

        function getPrice() {
            /* var product = $(".product_checkbox:checked").val();
             var additional = $(".additional_checkbox:checked").val();
             var days = $("#days").val();
             var amount = $("#amount").val();
             var amount_additional = $("#amount_additional").val();*/

            var form = $("#form").serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'POST',
                url: '{{ route('ajax.get_price') }}',
                data: {
                    form: form
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

        function getFormData($form) {
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function (n, i) {
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }
    </script>
@endsection
