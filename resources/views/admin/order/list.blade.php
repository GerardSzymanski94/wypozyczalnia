@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if(\Illuminate\Support\Facades\Session::has('message'))

                    <div class="alert alert-success">
                        {{ \Illuminate\Support\Facades\Session::get('message') }}
                    </div>
                @endif
                <form action="{{ route('admin.order.index') }}" method="get" role="search">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" name="p"
                               placeholder="Szukaj emaila" value="{{ $p }}">
                        @isset($count)
                            <p>Znaleziono: {{ $count }} produktów</p>
                        @endisset

                        <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                            {{ $order->price() }}
                        </td>
                        <td>
                            {{ $order->showStatus() }}
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('admin.order.details', ['order'=>$order->id]) }}"
                                   class="btn btn-secondary btn-primary"><i class="fa fa-edit"></i>Szczegóły</a>

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $orders->links() }}
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

        $(function () {
            $('table').tablesorter({
                widgets: ['zebra', 'columns'],
                usNumberFormat: false,
                sortReset: true,
                sortRestart: true
            });
        });
    </script>
@endsection