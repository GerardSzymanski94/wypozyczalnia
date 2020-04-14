@extends('layouts.app')

@section('content')
<section class="MainSection-orders">
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-md-12">
                @if(\Illuminate\Support\Facades\Session::has('message'))

                    <div class="alert alert-success">
                        {{ \Illuminate\Support\Facades\Session::get('message') }}
                    </div>
                @endif

                <div class="MainSection-orders-panel">
                    <div class="MainSection-orders-header">
                        <h2 class="MainSection-orders--title">Zamówienia</h2>
                    </div>
                    <div class="MainSection-orders-content">
                        <ul class="MainSection-orders-table">
                            <li class="MainSection-orders-table-row MainSection-orders-table-cell-header">
                                <div class="MainSection-orders-table-cell MainSection-orders-table--data">Data</div>
                                <div class="MainSection-orders-table-cell MainSection-orders-table--price">Cena</div>
                                <div class="MainSection-orders-table-cell MainSection-orders-table--status">Status</div>
                                <div class="MainSection-orders-table-cell MainSection-orders-table--more">Więcej</div>
                            </li>

                            @foreach($orders as $order)
                            <li class="MainSection-orders-table-row">
                                <div class="MainSection-orders-table-cell MainSection-orders-table--data">
                                    <div class="MainSection-orders-table-cell-name">Data</div>
                                    <span>{{ $order->created_at }}</span>
                                </div>
                                <div class="MainSection-orders-table-cell MainSection-orders-table--price">
                                    <div class="MainSection-orders-table-cell-name">Cena</div>
                                    <span>{{ $order->price() }} zł</span>
                                </div>
                                <div class="MainSection-orders-table-cell MainSection-orders-table--status">
                                    <div class="MainSection-orders-table-cell-name">Status</div>
                                    <span>{{ $order->showStatus() }}</span>
                                </div>
                                <div class="MainSection-orders-button-group btn-group MainSection-orders-table--more" role="group" aria-label="Basic example">
                                    <a href="{{ route('user.details', ['order'=>$order->id]) }}"
                                    class="btn btn-secondary btn-primary MainSection-orders-button">
                                        <i class="MainSection-orders-button-icon fa fa-list"></i>
                                        <span>Szczegóły</span>
                                    </a>
                                    <a href="{{ route('create_pdf', ['order'=>$order->id]) }}"
                                    class="btn btn-secondary btn-danger MainSection-orders-button">
                                        <i class="MainSection-orders-button-icon fa fa-file-pdf-o"></i>
                                        <span>Pobierz umowę</span>
                                    </a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script>
        $('#search').on('keyup', function () {
            let src = $('#search').val().toLowerCase();
            $('.news-title').each(function () {

                var dInput = $(this).text().toLowerCase();

                if (dInput.indexOf(src) != -1) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        });
    </script>
@endsection