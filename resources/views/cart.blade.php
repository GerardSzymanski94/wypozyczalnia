@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if($order !== null)
                            <table class="table">
                                <thead>
                                </thead>
                                <tbody>
                                @foreach($order->orderProducts as $product)
                                    @if($product->product->status ==1)
                                        <tr>
                                            <td>
                                                {{ $product->product->name }}
                                            </td>
                                            <td>
                                                <input type="number" name="product[{{ $product->id }}]"
                                                       value="{{ $product->amount }}" min="1"
                                                       class="order_product_amount"
                                                       data-id="{{ $product->id }}">
                                            </td>
                                            <td>
                                                <input type="number" name="product[{{ $product->id }}]"
                                                       value="{{ $product->days }}" min="1" class="order_product_days"
                                                       data-id="{{ $product->id }}"> dni
                                            </td>
                                            <td id="product_price_{{ $product->id }}">
                                                {{ $product->price }} zł
                                            </td>
                                            <td>
                                                <a href="{{ route('delete', ['product'=>$product->id]) }}"
                                                   class="btn btn-danger"> Usuń z koszyka</a>
                                            </td>
                                        </tr>

                                    @else
                                        <tr>
                                            <td>
                                                {{ $product->product->name }}
                                            </td>
                                            <td>
                                                <input type="number" name="product[{{ $product->id }}]"
                                                       value="{{ $product->amount_additional }}" min="1"
                                                       class="order_product_amount"
                                                       data-id="{{ $product->id }}">
                                            </td>
                                            <td>

                                            </td>
                                            <td id="product_price_{{ $product->id }}">
                                                {{ $product->price }} zł
                                            </td>
                                            <td>
                                                <a href="{{ route('delete', ['product'=>$product->id]) }}"
                                                   class="btn btn-danger"> Usuń z koszyka</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td>
                                        Podsumowanie:
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td id="total_price">
                                        {{ $order->price() }} zł
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="{{ route('data') }}" class="btn btn-primary">Przejdź dalej</a>
                        @else
                            <p>Koszyk jest pusty</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    </script>

@endsection
