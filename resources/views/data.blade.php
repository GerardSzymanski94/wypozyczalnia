@extends('layouts.app')

@section('content')
    <section class="MainSection-summary container">

        @if(isset($checkAmounts))
            <div class="row justify-content-center" id="check_amount">
                <div class="col-12">
                    <div class="alert alert-danger">
                        Dodałeś do koszyka więcej produktów niż jest dostępny. Sprawdź dostępność i dodaj je ponownie
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="MainSection-summary_panel">
                    <div class="MainSection-summary-header">
                        <h2 class="MainSection-summary--title">Podsumowanie zamówienia</h2>
                    </div>

                    <div class="MainSection-summary_content">
                        @if($order !== null)
                            <ul class="MainSection-summary-list">
                                <li class="MainSection-summary-list-item MainSection-summary-list-item-header">
                                    <div class="MainSection-summary-list-cell MainSection-summary-list-product">
                                        Produkt
                                    </div>
                                    <div class="MainSection-summary-list-cell MainSection-summary-list-count">Ilość
                                    </div>
                                    <div class="MainSection-summary-list-cell MainSection-summary-list-days">Dni</div>
                                    <div class="MainSection-summary-list-cell MainSection-summary-list-price">Cena</div>
                                    <div class="MainSection-summary-list-cell MainSection-summary-list-deposit">Kaucja
                                    </div>
                                </li>
                                @foreach($order->orderProducts as $product)
                                    <li class="MainSection-summary-list-item">
                                        <div class="MainSection-summary-list-cell MainSection-summary-list-product">
                                            <div class="MainSection-summary-list-name">Produkt</div>
                                            <span class="MainSection-summary-list--product">@if($product->product->status==2)
                                                    +
                                                @endif {{ $product->product->name }}</span>
                                        </div>
                                        <div class="MainSection-summary-list-cell MainSection-summary-list-count">
                                            <div class="MainSection-summary-list-name">Ilość</div>
                                            @if($product->product->status==2)
                                                {{ $product->amount_additional }}
                                            @else
                                                {{ $product->amount }}
                                            @endif
                                        </div>
                                        <div class="MainSection-summary-list-cell MainSection-summary-list-days">
                                            <div class="MainSection-summary-list-name">Dni</div>
                                            <span>
                                                @if($product->product->status==1)
                                                    {{ $product->days }} dni
                                                @endif </span>
                                        </div>
                                        <div class="MainSection-summary-list-cell MainSection-summary-list-price">
                                            <div class="MainSection-summary-list-name">Cena</div>
                                            <span>{{ $product->price }} zł</span>
                                        </div>
                                        <div class="MainSection-summary-list-cell MainSection-summary-list-deposit">
                                            <div class="MainSection-summary-list-name">Kaucja</div>
                                            @if(isset($product->deposit) && $product->deposit>0)
                                                <span style="color: red;">{{ $product->deposit }}</span>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Koszyk jest pusty</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('save') }}" method="post" class="MainSection-summary-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-7 col-lg-8">
                            <div class="MainSection-summary-form--box">
                                <div class="row">
                                    <div class="col-12 col-lg-10">
                                        <h2 class="MainSection-summary-form--header">Dane do wysyłki</h2>
                                    </div>                                    
                                    <div class="col-12 col-lg-10">
                                        <label for="name">Imię <span class="required">*</span></label>
                                        <input type="text" name="name" id="name"
                                            class="form-control MainSection-summary-form-control"
                                            value="{{ old('name', $user->name ?? '') }}">

                                        @if($errors->has('name'))
                                            <p class="alert alert-danger"> {{ $errors->first('name') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-10">
                                        <label for="surname">Nazwisko <span class="required">*</span></label>
                                        <input type="text" name="surname" id="surname"
                                            class="form-control MainSection-summary-form-control"
                                            value="{{ old('surname', $user->surname ?? '') }}">

                                        @if($errors->has('surname'))
                                            <p class="alert alert-danger"> {{ $errors->first('surname') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-10">
                                        <label for="city">Miasto <span class="required">*</span></label>
                                        <input type="text" name="city" id="city"
                                            class="form-control MainSection-summary-form-control"
                                            value="{{ old('city', $user->city ?? '') }}">

                                        @if($errors->has('city'))
                                            <p class="alert alert-danger"> {{ $errors->first('city') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-10">
                                        <label for="street">Ulica <span class="required">*</span></label>
                                        <input type="text" name="street" id="street"
                                            class="form-control MainSection-summary-form-control"
                                            value="{{ old('street', $user->street ?? '') }}">

                                        @if($errors->has('street'))
                                            <p class="alert alert-danger"> {{ $errors->first('street') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-10">
                                        <label for="zip_code">Kod pocztowy <span class="required">*</span></label>
                                        <input type="text" name="zip_code" id="zip_code"
                                            class="form-control MainSection-summary-form-control"
                                            value="{{ old('zip_code', $user->zip_code ?? '') }}">

                                        @if($errors->has('zip_code'))
                                            <p class="alert alert-danger">{{ $errors->first('zip_code') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-lg-10">
                                        <div class="MainSection-summary-form-rule">
                                            <label for="invoice" class="require MainSection-summary-form--label">
                                                <span>Chcę fakturę</span>
                                            </label>
                                            <input type="checkbox" name="invoice" id="invoice" class="checkbox">
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row invoice" style="display: none">
                                    <div class="col-12 col-lg-10">
                                        <button class="MainSection-summary-form--copy-button invoice" style="display: none">SKOPIUJ Z DANYCH DO WYSYŁKI</button>
                                    </div>
                                    <div class="col-12 col-lg-10 invoice" style="display: none">
                                        <h2 class="MainSection-summary-form--header">Dane do faktury</h2>
                                    </div>
                                    <div class="col-12 col-lg-10 invoice" style="display: none">
                                        <label for="name_invoice">Nazwa firmy/imię i nazwisko <span></span></label>
                                        <input type="text" name="name_invoice" id="name_invoice"
                                            class="form-control MainSection-summary-form-control"
                                            value="{{ old('name_invoice', $user->name_invoice ?? '') }}">

                                        @if($errors->has('name_invoice'))
                                            <p class="alert alert-danger"> {{ $errors->first('name_invoice') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-10 invoice" style="display: none">
                                        <label for="city_invoice">Miasto <span class="required">*</span></label>
                                        <input type="text" name="city_invoice" id="city_invoice"
                                            class="form-control MainSection-summary-form-control"
                                            value="{{ old('city_invoice', $user->city_invoice ?? '') }}">

                                        @if($errors->has('city_invoice'))
                                            <p class="alert alert-danger"> {{ $errors->first('city_invoice') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-10 invoice" style="display: none">
                                        <label for="street_invoice">Ulica <span class="required">*</span></label>
                                        <input type="text" name="street_invoice" id="street_invoice"
                                            class="form-control MainSection-summary-form-control"
                                            value="{{ old('street_invoice', $user->street_invoice ?? '') }}">

                                        @if($errors->has('street_invoice'))
                                            <p class="alert alert-danger"> {{ $errors->first('street_invoice') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-10 invoice" style="display: none">
                                        <label for="zip_code_invoice">Kod pocztowy <span class="required">*</span></label>
                                        <input type="text" name="zip_code_invoice" id="zip_code_invoice"
                                            class="form-control MainSection-summary-form-control"
                                            value="{{ old('zip_code_invoice', $user->zip_code_invoice ?? '') }}">

                                        @if($errors->has('zip_code_invoice'))
                                            <p class="alert alert-danger"> {{ $errors->first('zip_code_invoice') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-10 invoice" style="display: none">
                                        <label for="nip_invoice">NIP <span class="required">*</span></label>
                                        <input type="text" name="nip_invoice" id="nip_invoice"
                                            class="form-control MainSection-summary-form-control mb-0"
                                            value="{{ old('nip_invoice', $user->nip_invoice ?? '') }}">

                                        @if($errors->has('nip_invoice'))
                                            <p class="alert alert-danger"> {{ $errors->first('nip_invoice') }} </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="MainSection-summary-form--box">
                                <div class="row">
                                    <div class="col-12 col-lg-10">
                                        <h2 class="MainSection-summary-form--header">Rodzaję wysyłki</h2>
                                        <ul class="MainSection-summary-form-delivery">
                                            @foreach($deliveries as $delivery)
                                                <li class="MainSection-summary-form-delivery--type">
                                                    <label for="delivery_{{ $delivery->id }}" class="MainSection-summary-form-delivery--label">
                                                        <div class="MainSection-summary-form-delivery--center">
                                                            <input type="radio" id="delivery_{{ $delivery->id }}" class="MainSection-summary-form-delivery--radio check_radio radio_delivery_{{ $delivery->name }}" name="delivery" value="{{ $delivery->id }}" required>
                                                            <span>{{ $delivery->name }} </span>
                                                        </div>
                                                        <span>{{ $delivery->price }}zł</span>
                                                    </label>
                                                    @if(isset($delivery->additional) && !is_null($delivery->additional))
                                                        <input type="text" placeholder="{{ $delivery->additional }}" name="delivery_additional" class="MainSection-summary-form-delivery--number form-control">
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-5 col-lg-4">
                            <div class="MainSection-summary-form--box-summary sticky-element">
                                <div class="MainSection-summary-form--box-summary--text">
                                    <p class="MainSection-summary-form--box-summary--title">Podsumowanie:</p>
                                    <p class="MainSection-summary-form--box-summary--price">
                                        <span class="MainSection-summary-form--box-summary--small-name">Do zapłaty: </span>
                                        <span class="MainSection-summary-form--box-summary--big-price">{{ $order->price() }}zł</span>
                                    </p>
                                </div>

                                <div class="MainSection-summary-form-rules">
                                    <div class="MainSection-summary-form-rule">
                                        <label for="terms" class="MainSection-summary-form--label">
                                            <span>Akceptuje</span>
                                            <a href="{{ route('terms') }}" target="_blank">
                                                <span>regulamin</span>
                                                <span class="required">*</span>
                                            </a>
                                        </label>
                                        <input type="checkbox" name="terms" id="terms" required>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap">
                                    <a href="{{ route('cart') }}" class="btn btn-ending full-width">Powrót do koszyka</a>
                                    <button id="btn_submit" type="submit" class="btn btn-ending full-color full-width">Zamawiam</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $('body').on('click', '#invoice', function (e) {
            e.preventDefault();
            
            $('.invoice').toggle();
        });

        $('body').on('click', '.MainSection-summary-form--copy-button', function(e) {
            e.preventDefault();
            
            $name = $('#name');
            $surname = $('#surname');
            $city = $('#city');
            $street = $('#street');
            $zip_code = $('#zip_code');
            
            $name_invoice = $('#name_invoice');
            $surname_invoice = $('#surname_invoice');
            $city_invoice = $('#city_invoice');
            $street_invoice = $('#street_invoice');
            $zip_code_invoice = $('#zip_code_invoice');

            if( $name && $surname && $city && $street && $zip_code ) {
                $name_invoice.val($name.val());
                $surname_invoice.val($surname.val());
                $city_invoice.val($city.val());
                $street_invoice.val($street.val());
                $zip_code_invoice.val($zip_code.val());
            } else {
                return
            }
        });
    </script>
@endsection
