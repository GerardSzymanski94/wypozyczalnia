@extends('layouts.app')

@section('content')
    <form>
        <div class="container">
            <div class="row justify-content-center" id="added_to_cart" style="display: none;">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        Dodano do koszyka
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" id="check_amount" style="display: none;">
                <div class="col-md-8">
                    <div class="alert alert-danger">
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
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="MainSection-chooseProduct">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="MainSection-chooseProduct--title">Wybierz produkt</h2>
                        <div class="row">
                            @foreach($products as $product)
                                <label class="col-md-4 product_card" for="product_{{ $product->id }}" data-id="{{ $product->id }}">
                                    <div id="{{ $product->id }}">
                                        <div class="card" style="">
                                            <img src="{{ asset('storage/'. $product->getMainPhoto->url) }}" lass="card-img-top" alt="...">
                                            <div class="card-body">
                                                <p class="card-text">{{ $product->name }}</p>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    Dostępna ilość: {{ $product->amount }}
                                                </li>
                                                <li class="list-group-item">7 dni - {{ $product->price_one_week }}zł /
                                                    dzień
                                                </li>
                                                <li class="list-group-item">14 dni - {{ $product->price_two_week }}zł /
                                                    dzień
                                                </li>
                                                <li class="list-group-item">21 dni - {{ $product->price_three_week }}zł
                                                    /
                                                    dzień
                                                </li>
                                                <li class="list-group-item">28 dni - {{ $product->price_four_week }}zł /
                                                    dzień
                                                </li>
                                                <li class="list-group-item">>28 dni - {{ $product->price_more_month }}zł
                                                    /
                                                    dzień
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </label>
                                <input type="checkbox" name="product[{{ $product->id }}]" class="product_checkbox" value="{{ $product->id }}" style="display: none;" id="product_{{ $product->id }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h2>Ilość urządzeń</h2>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="amount">Ilość urządzeń<span
                                            class="required">*</span></label>
                                <input type="number" name="amount" id="amount" class="form-control" step="1" value="1">

                                @if($errors->has('amount'))
                                    <p class="alert alert-danger"> {{ $errors->first('amount') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section_2">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h2>Wybierz liczbę dni</h2>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="days">Liczba dni <span class="required">*</span></label>
                                <input type="number" name="days" id="days" class="form-control" step="1" value="1">

                                @if($errors->has('days'))
                                    <p class="alert alert-danger"> {{ $errors->first('days') }} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr>

        <section class="section_3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h2>Wybierz dodatki</h2>
                        <div class="row">
                            @foreach($additionals as $additional)
                                <label class="col-md-4 additional_card" for="additional_{{ $additional->id }}"
                                        data-id="{{ $additional->id }}">
                                    <div id="{{ $additional->id }}">
                                        <div class="card" style="">
                                            <img src="{{ asset('storage/'. $additional->getMainPhoto->url) }}"
                                                    class="card-img-top"
                                                    alt="...">
                                            <div class="card-body">
                                                <p class="card-text">{{ $additional->name }}</p>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    Dostępna ilość: {{ $additional->amount }}
                                                </li>
                                                <li class="list-group-item">
                                                    {{ $additional->price_one_week }} zł
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </label>
                                <input type="checkbox" name="additional[{{ $additional->id }}]"
                                        class="additional_checkbox" style="display: none;"
                                        id="additional_{{ $additional->id }}" value="{{ $additional->id }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section_6">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h2>Ilość zestawów elektrod</h2>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="amount_additional">Ilość zestawów elektrod<span
                                            class="required">*</span></label>
                                <input type="number" name="amount_additional" id="amount_additional"
                                        class="form-control" step="1" value="1">

                                @if($errors->has('amount_additional'))
                                    <p class="alert alert-danger"> {{ $errors->first('amount_additional') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr>

        <section class="section_6">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p><span id="price">0</span> zł</p>
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
            $(this).css({
                "border-color": "#000",
                "border-width": "2px",
                "border-style": "solid"
            });
            $("#product_" + $(this).data('id')).is(":checked");
        });
        $('body').on('click', '.additional_card', function () {
            clearAdditionals();
            $(this).css({
                "border-color": "#000",
                "border-width": "2px",
                "border-style": "solid"
            });
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
                            scrollTop: $("#added_to_cart").offset().top
                        },
                        'slow');
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
                $(this).css({
                    "border-width": "0px",
                    "border-style": "none"
                });
            });
        }

        function clearAdditionals() {
            $('.additional_card').each(function () {
                $(this).css({
                    "border-width": "0px",
                    "border-style": "none"
                });
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
