@extends('layouts.app')

@section('content')
    <section class="MainSection-details-order container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="MainSection-details-order-panel">
                    <div class="MainSection-details-order-header">
                        <h2 class="MainSection-details-order-header--title">Szczegóły zamówienia</h2>
                    </div>

                    <div class="MainSection-details-order_content">
                        <div class="MainSection-details-order-user-adress">
                            <h2 class="MainSection-details-order-user--title">Dane użytkownika</h2>
                            <ul class="MainSection-details-order-user--list">
                                <li class="MainSection-details-order-user--text">Email: {{ $order->user->email }}</li>
                                <li class="MainSection-details-order-user--text">Imię: {{ $order->user->name }}</li>
                                <li class="MainSection-details-order-user--text">
                                    Nazwisko: {{ $order->user->surname }}</li>
                                <li class="MainSection-details-order-user--text">Adres: {{ $order->user->street }}
                                    , {{ $order->user->city }}, {{ $order->user->zip_code }}</li>
                            </ul>
                            @if(isset($order->delivery))
                                <h2>Metoda wysyłki</h2>
                                <ul class="MainSection-details-order-user--list">
                                    <li class="MainSection-details-order-user--text"> {{ $order->delivery->name }} {{ $order->delivery_additional }}
                                        - {{ $order->delivery->price }} zł</a>
                                    </li>
                                </ul>
                            @endif
                        </div>

                        <div class="MainSection-details-order-panel">
                            <div class="MainSection-details-order-content">
                                <ul class="MainSection-details-order-table">
                                    <li class="MainSection-details-order-table-row MainSection-details-order-table-cell-header">
                                        <div class="MainSection-details-order-table-cell MainSection-details-order-table--product">
                                            Produkt
                                        </div>
                                        <div class="MainSection-details-order-table-cell MainSection-details-order-table--count">
                                            Ilość
                                        </div>
                                        <div class="MainSection-details-order-table-cell MainSection-details-order-table--price">
                                            Cena
                                        </div>
                                        <div class="MainSection-details-order-table-cell MainSection-details-order-table--price">
                                            Kaucja
                                        </div>
                                        <div class="MainSection-details-order-table-cell MainSection-details-order-table--date">
                                            Data oddania
                                        </div>
                                        <div class="MainSection-details-order-table-cell MainSection-details-order-table--status">
                                            Status
                                        </div>
                                    </li>

                                    @foreach($order->orderProducts as $orderProduct)
                                        <li class="MainSection-details-order-table-row">
                                            <div class="MainSection-details-order-table-cell MainSection-details-order-table--product">
                                                <div class="MainSection-details-order-table-cell-name">Produkt</div>
                                                <span>{{ $orderProduct->product->name }}</span>
                                            </div>
                                            <div class="MainSection-details-order-table-cell MainSection-details-order-table--count">
                                                <div class="MainSection-details-order-table-cell-name">Ilość</div>
                                                <span>@if($orderProduct->product->status==1){{ $orderProduct->amount }}@else
                                                        {{ $orderProduct->amount_additional }}@endif</span>
                                            </div>
                                            <div class="MainSection-details-order-table-cell MainSection-details-order-table--price">
                                                <div class="MainSection-details-order-table-cell-name">Cena</div>
                                                <span>   {{ $orderProduct->price }} zł</span>
                                            </div>
                                            <div class="MainSection-details-order-table-cell MainSection-details-order-table--price">
                                                <div class="MainSection-details-order-table-cell-name">Kaucja</div>
                                                <span>{{ $orderProduct->deposit }}
                                                    zł</span>
                                            </div>
                                            <div class="MainSection-details-order-table-cell MainSection-details-order-table--date">
                                                <div class="MainSection-details-order-table-cell-name">Data oddania
                                                </div>
                                                <span>{{ $orderProduct->showDay() }}</span>
                                            </div>
                                            <div class="MainSection-details-order-table-cell MainSection-details-order-table--status">
                                                <div class="MainSection-details-order-table-cell-name">Status</div>
                                                <span>{{ $orderProduct->showStatus() }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class=" ">
                                        <span class="MainSection-summary-list-price-summary">Do zapłaty: {{ $order->price() }}
                                            zł</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection