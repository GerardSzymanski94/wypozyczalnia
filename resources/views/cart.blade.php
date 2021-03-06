@extends('layouts.app')

@section('content')
    <section class="MainSection-cart container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="MainSection-cart-header">
                        <h2 class="MainSection-cart--title">Koszyk</h2>
                    </div>
                    <div class="MainSection-cart-content">
                        @if($order !== null)
                            <ul class="MainSection-cart-list">
                                <li class="MainSection-cart-item MainSection-cart-item-header">
                                    <div class="MainSection-cart-item-cell MainSection-cart-item--product">
                                        <span>Produkt</span>
                                    </div>
                                    <div class="MainSection-cart-item-cell MainSection-cart-item--count">
                                        <span>Ilość</span>
                                    </div>
                                    <div class="MainSection-cart-item-cell MainSection-cart-item--days">
                                        <span>Początek wypożyczenia</span>
                                    </div>
                                    <div class="MainSection-cart-item-cell MainSection-cart-item--days">
                                        <span>Dni</span>
                                    </div>
                                    <div class="MainSection-cart-item-cell MainSection-cart-item--price">
                                        <span>Cena</span>
                                    </div>
                                    <div class="MainSection-cart-item-cell MainSection-cart-item--deposit">
                                        <span>Kaucja</span>
                                    </div>
                                    <div class="MainSection-cart-item-cell MainSection-cart-item--button"></div>
                                </li>

                                @foreach($order->orderProducts as $product)
                                    @if($product->product->status == 1)
                                        <li class="MainSection-cart-item">
                                            <div class="MainSection-cart-item-cell MainSection-cart-item--product">
                                                <div class="MainSection-cart-item-name"><span>Produkt</span></div>
                                                <span
                                                    class="MainSection-cart-item-name-product">{{ $product->product->name }}</span>
                                            </div>
                                            <div class="MainSection-cart-item-cell MainSection-cart-item--count">
                                                <div class="MainSection-cart-item-name"><span>Ilość</span></div>
                                                <input type="number" name="product[{{ $product->id }}]"
                                                       value="{{ $product->amount }}" min="1"
                                                       class="order_product_amount MainSection-cart-item--input"
                                                       data-id="{{ $product->id }}">
                                            </div>
                                            <div class="MainSection-cart-item-cell MainSection-cart-item--date MainSection-cart-item--days">
                                                <div class="MainSection-cart-item-name"><span></span></div>
                                                <input type="date" name="date[{{ $product->id }}]"
                                                       value="{{ \Carbon\Carbon::parse($product->start_date)->format('Y-m-d') }}"
                                                       class="order_product_date MainSection-cart-item--input2 MainSection-cart-item--input"
                                                       data-id="{{ $product->id }}">
                                            </div>
                                            <div class="MainSection-cart-item-cell MainSection-cart-item--days">
                                                <div class="MainSection-cart-item-name"><span>Dni</span></div>
                                                <input type="number" name="product[{{ $product->id }}]"
                                                       value="{{ $product->days }}" min="1"
                                                       class="order_product_days MainSection-cart-item--input"
                                                       data-id="{{ $product->id }}">
                                            </div>
                                            <div id="product_price_{{ $product->id }}"
                                                 class="MainSection-cart-item-cell MainSection-cart-item--price">
                                                <div class="MainSection-cart-item-name"><span>Cena</span></div>
                                                <span> {{ $product->price }} zł</span>
                                            </div>
                                            <div class="MainSection-cart-item-cell MainSection-cart-item--deposit">
                                                <div class="MainSection-cart-item-name"><span class=>Kaucja</span></div>
                                                <span class="color-red">{{ $product->deposit }} zł</span>
                                            </div>
                                            <div class="MainSection-cart-item-cell MainSection-cart-item--button">
                                                <a href="{{ route('delete', ['product'=>$product->id]) }}"
                                                   class="btn btn-danger"> Usuń z koszyka</a>
                                            </div>
                                        </li>
                                    @else
                                        <li class="MainSection-cart-item">
                                            <div class="MainSection-cart-item-cell MainSection-cart-item--product">
                                                <div class="MainSection-cart-item-name"><span>Produkt</span></div>
                                                <span>+ {{ $product->product->name }}</span>
                                            </div>
                                            <div class="MainSection-cart-item-cell MainSection-cart-item--count">
                                                <div class="MainSection-cart-item-name"><span>Ilość</span></div>
                                                <input type="number" name="product[{{ $product->id }}]"
                                                       value="{{ $product->amount_additional }}" min="1"
                                                       class="order_product_amount MainSection-cart-item--input"
                                                       data-id="{{ $product->id }}">
                                            </div>
                                            <div
                                                class="MainSection-cart-item-cell MainSection-cart-item--date disable-mobile" style="width: 170px;"></div>
                                            <div
                                                class="MainSection-cart-item-cell MainSection-cart-item--days disable-mobile"></div>
                                            <div id="product_price_{{ $product->id }}"
                                                 class="MainSection-cart-item-cell MainSection-cart-item--price">
                                                <div class="MainSection-cart-item-name"><span>Cena</span></div>
                                                <span>{{ $product->price }} zł</span>
                                            </div>
                                            <div
                                                class="MainSection-cart-item-cell MainSection-cart-item--price disable-mobile"></div>
                                            <div class="MainSection-cart-item-cell MainSection-cart-item--button">
                                                <a href="{{ route('delete', ['product'=>$product->id]) }}"
                                                   class="btn btn-danger"> Usuń z koszyka</a>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <div class="MainSection-cart-summary">
                                <p class="MainSection-cart-summary--text">
                                    <span>Podsumowanie:</span>
                                    <span id="total_price">{{ $order->price() }}zł</span>
                                </p>
                                <div class="MainSection-cart-summary-buttons">
                                    <a href="{{ url('/') }}" class="btn btn-ending MainSection-cart-summary--button">Dodaj
                                        koleny zestaw</a>
                                    <a href="{{ route('data') }}"
                                       class="btn btn-ending full-color MainSection-cart-summary--button">Dokończ
                                        zamówienie</a>
                                </div>
                            </div>
                        @else
                            <p>Koszyk jest pusty</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

    <script>

        $('body').on('change', '.order_product_amount', function () {
            let product = $(this).data('id');
            let amount = $(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'POST',
                url: '{{ route('ajax.update_amount') }}',
                data: {
                    product: product,
                    amount: amount
                },
                success: function (data) {
                    $('#product_price_' + data.id).empty().append(data.price + " " + "zł");
                    $('#total_price').empty().append(data.total_price + " " + "zł");
                },
                error:
                    function (jqXHR, textStatus, errorThrown) {
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
            });
        });

        $('body').on('change', '.order_product_days', function () {
            let product = $(this).data('id');
            let days = $(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'POST',
                url: '{{ route('ajax.update_days') }}',
                data: {
                    product: product,
                    days: days
                },
                success: function (data) {
                    $('#product_price_' + data.id).empty().append(data.price + " " + "zł");
                    $('#total_price').empty().append(data.total_price + " " + "zł");
                },
                error:
                    function (jqXHR, textStatus, errorThrown) {
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
            });
        });
        $('body').on('change', '.order_product_date', function () {
            let product = $(this).data('id');
            //let days = $(this).val();
            let date = $(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'POST',
                url: '{{ route('ajax.update_date') }}',
                data: {
                    product: product,
                    date: date
                },
                success: function (data) {

                },
                error:
                    function (jqXHR, textStatus, errorThrown) {
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
            });
        });


        $('body').on('click', '.MainSection-alerts-close', () => {
            $('.check_alert').hide();
        })

    </script>

@endsection
