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
                                            @if(isset($product->product->deposit) && $product->product->deposit>0)
                                                <span style="color: red;">{{ $product->product->deposit }}</span>
                                            @endif
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
                            <label for="zip_code">Kod pocztowy <span class="required">*</span></label>
                            <input type="text" name="zip_code" id="zip_code" class="form-control"
                                   value="{{ old('zip_code', $user->zip_code ?? '') }}">

                            @if($errors->has('zip_code'))
                                <p class="alert alert-danger"> {{ $errors->first('zip_code') }}
                                </p>
                            @endif
                        </div>

                    </div>

                    <hr>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="invoice">Chcę fakturę <span class="required"></span></label>
                            <input type="checkbox" name="invoice" id="invoice" class="checkbox">
                        </div>
                    </div>
                    <div class="form-row invoice" style="display: none">
                        <div class="form-group col-md-12">
                            <h2>Dane do faktury</h2>
                        </div>
                    </div>

                    <div class="form-row invoice" style="display: none">
                        <div class="form-group col-md-6">
                            <label for="name_invoice">Nazwa firmy/imię i nazwisko <span></span></label>
                            <input type="text" name="name_invoice" id="name_invoice" class="form-control"
                                   value="{{ old('name_invoice', $user->name_invoice ?? '') }}">

                            @if($errors->has('name_invoice'))
                                <p class="alert alert-danger"> {{ $errors->first('name_invoice') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city_invoice">Miasto <span class="required">*</span></label>
                            <input type="text" name="city_invoice" id="city_invoice" class="form-control"
                                   value="{{ old('city_invoice', $user->city_invoice ?? '') }}">

                            @if($errors->has('city_invoice'))
                                <p class="alert alert-danger"> {{ $errors->first('city_invoice') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="form-row invoice" style="display: none">
                        <div class="form-group col-md-6">
                            <label for="street_invoice">Ulica <span class="required">*</span></label>
                            <input type="text" name="street_invoice" id="street_invoice" class="form-control"
                                   value="{{ old('street_invoice', $user->street_invoice ?? '') }}">

                            @if($errors->has('street_invoice'))
                                <p class="alert alert-danger"> {{ $errors->first('street_invoice') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="zip_code_invoice">Kod pocztowy <span class="required">*</span></label>
                            <input type="text" name="zip_code_invoice" id="zip_code_invoice" class="form-control"
                                   value="{{ old('zip_code_invoice', $user->zip_code_invoice ?? '') }}">

                            @if($errors->has('zip_code_invoice'))
                                <p class="alert alert-danger"> {{ $errors->first('zip_code_invoice') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="form-row invoice" style="display: none">
                        <div class="form-group col-md-6">
                            <label for="nip_invoice">NIP <span class="required">*</span></label>
                            <input type="text" name="nip_invoice" id="nip_invoice" class="form-control"
                                   value="{{ old('nip_invoice', $user->nip_invoice ?? '') }}">

                            @if($errors->has('nip_invoice'))
                                <p class="alert alert-danger"> {{ $errors->first('nip_invoice') }}
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

@section('scripts')
    <script>
        $('body').on('click', '#invoice', function () {
            $('.invoice').toggle();
        });
    </script>
@endsection
