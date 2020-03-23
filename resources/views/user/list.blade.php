@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="justify-content-center">
            <div class=" col-md-8">
                @if(\Illuminate\Support\Facades\Session::has('message'))

                    <div class="alert alert-success">
                        {{ \Illuminate\Support\Facades\Session::get('message') }}
                    </div>
                @endif

                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Data</th>
                                <th>Email</th>
                                <th>Cena</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            </tr>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        {{ $order->created_at }}
                                    </td>
                                    <td>
                                        {{ $order->user->email }}
                                    </td>
                                    <td class="news-title">
                                        {{ $order->price() }} zł
                                    </td>
                                    <td>
                                        {{ $order->showStatus() }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('user.details', ['order'=>$order->id]) }}"
                                               class="btn btn-secondary btn-primary"><i class="fa fa-list"></i>Szczegóły</a>
                                            <a href="{{ route('create_pdf', ['order'=>$order->id]) }}"
                                               class="btn btn-secondary btn-danger"><i class="fa fa-file-pdf-o"></i>Pobierz
                                                umowę</a>

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