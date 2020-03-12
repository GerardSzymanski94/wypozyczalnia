@extends('layouts.app')

@section('content')
    <div class="container">
        <form>
            <div class="row justify-content-center" id="added_to_cart" style="display: none;">
                <div class="col-md-8">
                    <div class="alert alert-success">
                        Dodano do koszyka
                    </div>
                </div>
            </div>
            @csrf
            <section class="section_0">

            </section>
            <hr>
            <section class="section_1">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h2>Wybierz produkt</h2>
                        <div class="row">
                            @foreach($products as $product)
                                <label class="col-md-4 product_card" for="product_{{ $product->id }}"
                                       data-id="{{ $product->id }}">
                                    <div id="{{ $product->id }}">
                                        <div class="card" style="">
                                            <img src="{{ asset('storage/'. $product->getMainPhoto->url) }}"
                                                 class="card-img-top"
                                                 alt="...">
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
                                <input type="checkbox" name="product[{{ $product->id }}]" class="product_checkbox"
                                       value="{{ $product->id }}" style="display: none"
                                       id="product_{{ $product->id }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <hr>
            <section class="section_3">
                <div class="row justify-content-center">
                    <div class="col-md-8">
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
                                                    Dostępna ilość: {{ $product->amount }}

                                                </li>
                                                <li class="list-group-item">7 dni - {{ $additional->price_one_week }}zł
                                                    /
                                                    dzień
                                                </li>
                                                <li class="list-group-item">14 dni - {{ $additional->price_two_week }}zł
                                                    /
                                                    dzień
                                                </li>
                                                <li class="list-group-item">21 dni - {{ $additional->price_three_week }}
                                                    zł /
                                                    dzień
                                                </li>
                                                <li class="list-group-item">28 dni
                                                    - {{ $additional->price_four_week }}zł /
                                                    dzień
                                                </li>
                                                <li class="list-group-item">>28 dni
                                                    - {{ $additional->price_more_month }}zł
                                                    /
                                                    dzień
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </label>
                                <input type="checkbox" name="additional[{{ $additional->id }}]"
                                       class="additional_checkbox" style="display: none"
                                       id="additional_{{ $additional->id }}" value="{{ $additional->id }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <hr>
            <section class="section_2">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h2>Wybierz liczbę dni</h2>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="days">Liczba dni <span
                                            class="required">*</span></label>
                                <input type="number" name="days" id="days" class="form-control" step="1" value="1">

                                @if($errors->has('days'))
                                    <p class="alert alert-danger"> {{ $errors->first('days') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <hr>
            <section class="section_6">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h2>Ilość</h2>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="amount">Ilość<span
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

            </section>
            <hr>

            <section class="section_4">
                {{--<a href="" class="btn btn-primary">
                    Sprawdź cenę
                </a>--}}
                <div class="btn btn-primary" id="add_product">
                    Dodaj do koszyka
                </div>
                <a href="{{ route('cart') }}" class="btn btn-primary">
                    Przejdź do koszyka
                </a>
            </section>
        </form>
    </div>
    <style>
        .section {
            margin-top: 30px;
        }
    </style>
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
            console.log($("#product_" + $(this).data('id')));
            $("#product_" + $(this).data('id')).is(":checked");
        });
        $('body').on('click', '.additional_card', function () {
            clearAdditionals();
            $(this).css({
                "border-color": "#000",
                "border-width": "2px",
                "border-style": "solid"
            });
            console.log($("#additional" + $(this).data('id')));
            $("#additional_" + $(this).data('id')).is(":checked");
        });

        $('body').on('click', '#add_product', function () {
            // alert('test');
            var product = $(".product_checkbox:checked").val();
            //   alert(product);
            var additional = $(".additional_checkbox:checked").val();
            var days = $("#days").val();
            var amount = $("#amount").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'POST',
                url: '{{ route('ajax.add_product') }}',
                data: {product: product, additional: additional, days: days, amount: amount},
                success: function (data) {
                    // $('.section_0').html(data.view);
                    $('#added_to_cart').show();
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
    </script>
@endsection
