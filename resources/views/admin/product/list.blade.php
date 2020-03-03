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
                    <th>Zdjęcie główne</th>
                    <th>Nazwa</th>
                    <th>Opis</th>
                    <th>Dostępne</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input placeholder="Wyszukaj produkt" id="search" class="form-control">
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.product.create') }}">
                            Dodaj produkt
                        </a>
                    </td>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td>
                            {{ $product->id }}
                        </td>
                        <td>
                            <img src="{{ asset('storage/'. $product->getMainPhoto->url) }}" height="100px" width="100px"
                                 class="float-left">
                        </td>
                        <td class="news-title">
                            {{ $product->name }}
                        </td>
                        <td class="news-content">
                            {{ substr($product->description, 0, 100) }}...
                        </td>
                        <td>

                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('admin.product.edit', ['product'=>$product->id]) }}"
                                   class="btn btn-secondary btn-primary"><i class="fa fa-edit"></i>Edytuj</a>
                                <a href="{{ route('admin.product.destroy', ['product'=>$product->id]) }}"
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
    </script>
@endsection