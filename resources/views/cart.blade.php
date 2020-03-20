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
                                                {{ $product->amount }}
                                            </td>
                                            <td>
                                                {{ $product->days }} dni
                                            </td>
                                            <td>
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
                                                {{ $product->amount_additional }}
                                            </td>
                                            <td>

                                            </td>
                                            <td>
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
                                    <td>
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

