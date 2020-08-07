@extends('admin.app')

@section('content')

    <div class="x_panel">
        @if(\Illuminate\Support\Facades\Session::has('series_save'))

            <div class="alert alert-success">
                Zaktualizowano numery
            </div>
        @endif
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
                <li>Adres: {{ $order->user->street }}, {{ $order->user->city }}, {{ $order->user->zip_code }}</li>
            </ul>

            @if($order->invoice==1)
                <h2>Użytkownik chce fakture</h2>
                <ul>
                    <li>Nazwa: {{ $order->user->name_invoice }}</li>
                    <li>NIP: {{ $order->user->nip_invoice }}</li>
                    <li>Adres: {{ $order->user->street_invoice }}, {{ $order->user->city_invoice }}
                        , {{ $order->user->zip_code_invoice }}</li>
                </ul>
            @endif

            <h2>Szczegóły zamówienia</h2>
            <ul>
                <li> Od : {{ $order->date_from }} <a href="{{ route('admin.order.edit', ['order'=>$order->id]) }}">Edytuj</a>
                </li>
            </ul>
            <h2>Metoda wysyłki</h2>
            <ul>
                <li> {{ $order->delivery->name }} {{ $order->delivery_additional }}</a>
                </li>
            </ul>
            <h2>Wyślij umowę do użytkownika</h2>
            <span class="text-danger"> Przed wysłaniem upewnij się, że są wpisane numery seryjne urządzeń</span>
            <ul>
                <li><a class="btn btn-primary" href="{{ route('admin.order.send', ['order'=>$order->id]) }}"> Wyślij
                        umowę</a>
                </li>
            </ul>


            <form action="{{ route('admin.orderproduct.series_save') }}" method="post">
                @csrf
                <table class="table">
                    <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Ilość</th>
                        <th>Cena</th>
                        <th>Kaucja</th>
                        <th>Data oddania</th>
                        <th>Numer</th>
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
                            <td>@if($orderProduct->product->status==1)
                                    {{ $orderProduct->amount }}
                                @else
                                    {{ $orderProduct->amount_additional }}
                                @endif
                            </td>
                            <td class="news-title">
                                {{ $orderProduct->price }}
                            </td>
                            <td>
                                {{ $orderProduct->deposit }}
                            </td>
                            <td>
                                {{ $orderProduct->showDay() }}
                            </td>
                            <td>
                                @if($orderProduct->product->status==1)
                                    <input type="text" value="{{ $orderProduct->series }}"
                                           name="series[{{ $orderProduct->id }}]">
                                @endif
                            </td>
                            <td>
                                @if($orderProduct->product->status==1)
                                    {{ $orderProduct->showStatus() }}
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @if($orderProduct->product->status==1)
                                        @if($orderProduct->status==2)
                                            <a class="btn btn-success"
                                               href="{{ route('admin.order.return', ['orderProduct'=>$orderProduct->id]) }}">Zwrócono</a>
                                        @elseif($orderProduct->status==3)
                                            <a class="btn btn-danger"
                                               href="{{ route('admin.order.unavailable', ['orderProduct'=>$orderProduct->id]) }}">Nie
                                                zwrócono</a>
                                        @endif
                                    @endif
                                    @if($orderProduct->product->status==1 && $orderProduct->status!=5 )
                                        <a class="btn btn-primary"
                                           href="{{ route('admin.orderproduct.extension', ['orderProduct'=>$orderProduct->id]) }}">Przedłuż
                                            okres wypożyczenia</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
                <input type="submit" class="btn btn-primary" value="Aktualizuj numery">
            </form>
        </div>
    </div>

@endsection
