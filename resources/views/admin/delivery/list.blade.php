@extends('admin.app')

@section('content')

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
                    <th></th>
                    <th>Zdjęcie</th>
                    <th>Nazwa</th>
                    <th>Cena</th>
                    <th>Dodatkowe pole</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input placeholder="Wyszukaj" id="search" class="form-control">
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.delivery.create') }}">
                            Dodaj metodę dostawy
                        </a>
                    </td>
                </tr>
                @foreach($deliveries as $delivery)
                    <tr>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td class="news-title">
                            {{ $delivery->name }}
                        </td>
                        <td class="news-content">
                            {{ $delivery->price }}...
                        </td>
                        <td>
                            {{ $delivery->additional }}
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('admin.delivery.edit', ['delivery'=>$delivery->id]) }}"
                                   class="btn btn-secondary btn-primary"><i class="fa fa-edit"></i>Edytuj</a>
                                <a href="{{ route('admin.delivery.destroy', ['delivery'=>$delivery->id]) }}"
                                   class="btn btn-secondary btn-danger"
                                   onclick="return confirm('Na pewno usunąć?');"><i class="fa fa-remove"></i>Usuń</a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
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