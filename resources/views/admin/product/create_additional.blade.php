@extends('admin.app')

@section('content')

    <div class="x_panel">
        <div class="x_title">
            <h2>Dodaj elektrody</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="{{ route('admin.product.store') }}" method="post" type="" class="form-horizontal"
                  enctype="multipart/form-data">

                @csrf

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h2>Dane o elektrodach</h2>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nazwa <span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ old('name', $product->name ?? '') }}">

                        @if($errors->has('name'))
                            <p class="alert alert-danger"> {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Opis <span class="required">*</span></label>
                        <textarea name="description" id="description"
                                  class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
                        @if($errors->has('description'))
                            <p class="alert alert-danger"> {{ $errors->first('description') }}
                            </p>
                        @endif
                    </div>


                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="amount">Ilość <span class="required">*</span></label>
                        <input type="text" name="amount" id="amount" class="form-control"
                               value="{{ old('amount', $product->amount ?? '') }}">

                        @if($errors->has('amount'))
                            <p class="alert alert-danger"> {{ $errors->first('amount') }}
                            </p>
                        @endif
                    </div>
                    <input type="hidden" name="status" value="2">
                    {{--<div class="form-group col-md-6">
                        <label for="status">Status <span class="required">*</span></label>

                        <select name="status" id="status" class="form-control">
                            <option value="1">
                                Produkt podstawowy
                            </option>
                            <option value="2">
                                Produkt dodatkowy
                            </option>
                        </select>

                        @if($errors->has('status'))
                            <p class="alert alert-danger"> {{ $errors->first('status') }}
                            </p>
                        @endif
                    </div>--}}
                </div>
                <hr>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h2>Cennik</h2>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price_one_week">Cena elektrod <span class="required">*</span></label>
                        <input type="number" name="price_one_week" id="price_one_week" class="form-control" step="0.01"
                               value="{{ old('price_one_week', $product->price_one_week ?? '') }}">

                        @if($errors->has('price_one_week'))
                            <p class="alert alert-danger"> {{ $errors->first('price_one_week') }}
                            </p>
                        @endif
                    </div>

                </div>

                <hr>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h2>Zdjęcia</h2>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="photo">Zdjęcie</label>
                        <input type="file" class="form-control-file" name="photo" id="photo">

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button type="submit" class="btn btn-success">Dodaj elektrody</button>
                            </div>
                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Anuluj</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection