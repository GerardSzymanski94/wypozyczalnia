@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="justify-content-center">
            <div class=" col-md-8">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Szczegóły zamówienia</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <h2>Dane użytkownika</h2>
                        <ul>
                            <li>Email: {{ $order->user->email }}</li>
                            <li>Imię: {{ $order->user->name }}</li>
                            <li>Nazwisko: {{ $order->user->surname }}</li>
                            <li>Adres: {{ $order->user->street }}, {{ $order->user->city }}
                                , {{ $order->user->zip_code }}</li>
                        </ul>
                        <h2>Szczegóły zamówienia</h2>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Produkt</th>
                                <th>Ilość</th>
                                <th>Cena</th>
                                <th>Data oddania</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            </tr>
                            @foreach($order->orderProducts as $orderProduct)
                                <tr>
                                    <td>
                                        {{ $orderProduct->product->name }}
                                    </td>
                                    <td>
                                        {{ $orderProduct->amount }}
                                    </td>
                                    <td class="news-title">
                                        {{ $orderProduct->price }} zł
                                    </td>
                                    <td>
                                        {{ $orderProduct->showDay() }}
                                    </td>
                                    <td>
                                        {{ $orderProduct->showStatus() }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection