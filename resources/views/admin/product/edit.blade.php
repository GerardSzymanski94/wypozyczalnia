@extends('admin.app')

@section('content')

    <div class="x_panel">
        <div class="x_title">
            <h2>Edytuj produkt</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="{{ route('admin.product.update', ['product'=>$product->id]) }}" method="post"
                  class="form-horizontal" enctype="multipart/form-data">

                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h2>Dane o produkcie</h2>
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

                    <input type="hidden" name="status" value="1">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="baselinker_id">ID produktu w Baselinker <span
                                    class="required">*</span></label>
                        <input type="text" name="baselinker_id" id="baselinker_id"
                               class="form-control"
                               value="{{ old('baselinker_id', $product->baselinker_id ?? '') }}">

                        @if($errors->has('baselinker_id'))
                            <p class="alert alert-danger"> {{ $errors->first('baselinker_id') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ean">EAN<span
                                    class="required">*</span></label>
                        <input type="text" name="ean" id="ean"
                               class="form-control"
                               value="{{ old('ean', $product->ean ?? '') }}">

                        @if($errors->has('ean'))
                            <p class="alert alert-danger"> {{ $errors->first('ean') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="sku">SKU <span
                                    class="required">*</span></label>
                        <input type="text" name="sku" id="sku"
                               class="form-control"
                               value="{{ old('sku', $product->sku ?? '') }}">

                        @if($errors->has('sku'))
                            <p class="alert alert-danger"> {{ $errors->first('sku') }}
                            </p>
                        @endif
                    </div>

                </div>
                <hr>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h2>Cennik</h2>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price_one_week">Cena za dzień do 1 tygodnia <span class="required">*</span></label>
                        <input type="number" name="price_one_week" id="price_one_week" class="form-control" step="0.01"
                               value="{{ old('price_one_week', $product->price_one_week ?? '') }}">

                        @if($errors->has('price_one_week'))
                            <p class="alert alert-danger"> {{ $errors->first('price_one_week') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price_two_week">Cena za dzień do 2 tygodnii <span class="required">*</span></label>
                        <input type="number" name="price_two_week" id="price_two_week" class="form-control" step="0.01"
                               value="{{ old('price_two_week', $product->price_two_week ?? '') }}">

                        @if($errors->has('price_two_week'))
                            <p class="alert alert-danger"> {{ $errors->first('price_two_week') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price_three_week">Cena za dzień do 3 tygodnii <span
                                    class="required">*</span></label>
                        <input type="number" name="price_three_week" id="price_three_week" class="form-control"
                               step="0.01"
                               value="{{ old('price_three_week', $product->price_three_week ?? '') }}">

                        @if($errors->has('price_three_week'))
                            <p class="alert alert-danger"> {{ $errors->first('price_three_week') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price_four_week">Cena za dzień do 4 tygodnii <span class="required">*</span></label>
                        <input type="number" name="price_four_week" id="price_four_week" class="form-control"
                               step="0.01"
                               value="{{ old('price_four_week', $product->price_four_week ?? '') }}">

                        @if($errors->has('price_four_week'))
                            <p class="alert alert-danger"> {{ $errors->first('price_four_week') }}
                            </p>
                        @endif
                    </div>


                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price_more_month">Cena za dzień za ponad 4 tygodnie <span
                                    class="required">*</span></label>
                        <input type="number" name="price_more_month" id="price_more_month"
                               class="form-control" step="0.01"
                               value="{{ old('price_more_month', $product->price_more_month ?? '') }}">

                        @if($errors->has('price_more_month'))
                            <p class="alert alert-danger"> {{ $errors->first('price_more_month') }}
                            </p>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="deposit">Kaucja <span
                                    class="required">*</span></label>
                        <input type="number" name="deposit" id="deposit"
                               class="form-control" step="0.01"
                               value="{{ old('deposit', $product->deposit ?? '') }}">

                        @if($errors->has('deposit'))
                            <p class="alert alert-danger"> {{ $errors->first('deposit') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="order">Kolejność wyświetlania <span class="required"></span></label>
                        <input type="number" name="order" id="order" class="form-control"
                               value="{{ old('order', $product->order ?? '') }}">

                        @if($errors->has('order'))
                            <p class="alert alert-danger"> {{ $errors->first('order') }}
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
                        @if(isset( $product->getMainPhoto->url))
                            <img src="{{ asset('storage/app/public/'. $product->getMainPhoto->url) }}" height="100px" width="100px"
                                 class="float-left">
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button type="submit" class="btn btn-success">Edytuj produkt</button>
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
