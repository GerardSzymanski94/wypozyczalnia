@extends('layouts.app')

@section('content')
    <div class="container">

        @if(isset($checkAmounts))
            <div class="row justify-content-center" id="check_amount">
                <div class="col-md-8">
                    <div class="alert alert-danger">
                        Dodałeś do koszyka więcej produktów niż jest dostępny. Sprawdź dostępność i dodaj je ponownie
                    </div>
                </div>
            </div>
        @endif
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
                                        </td>
                                    </tr>
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
                        @else
                            <p>Koszyk jest pusty</p>
                        @endif
                    </div>
                </div>
                <form action="{{ route('save') }}" method="post"
                      class="form-horizontal" enctype="multipart/form-data">

                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h2>Dane użytkownika</h2>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Imię <span class="required">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ old('name', $user->name ?? '') }}">

                            @if($errors->has('name'))
                                <p class="alert alert-danger"> {{ $errors->first('name') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="surname">Nazwisko <span class="required">*</span></label>
                            <input type="text" name="surname" id="surname" class="form-control"
                                   value="{{ old('surname', $user->surname ?? '') }}">

                            @if($errors->has('surname'))
                                <p class="alert alert-danger"> {{ $errors->first('surname') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">Miasto <span class="required">*</span></label>
                            <input type="text" name="city" id="city" class="form-control"
                                   value="{{ old('city', $user->city ?? '') }}">

                            @if($errors->has('city'))
                                <p class="alert alert-danger"> {{ $errors->first('city') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="street">Ulica <span class="required">*</span></label>
                            <input type="text" name="street" id="street" class="form-control"
                                   value="{{ old('street', $user->street ?? '') }}">

                            @if($errors->has('street'))
                                <p class="alert alert-danger"> {{ $errors->first('street') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="street">Kod pocztowy <span class="required">*</span></label>
                            <input type="text" name="street" id="street" class="form-control"
                                   value="{{ old('street', $user->street ?? '') }}">

                            @if($errors->has('street'))
                                <p class="alert alert-danger"> {{ $errors->first('street') }}
                                </p>
                            @endif
                        </div>

                    </div>


                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <button type="submit" class="btn btn-success">Zapisz i zakończ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

