@extends('admin.app')

@section('content')

    <div class="x_panel">
        <div class="x_title">
            <h2>Dodaj produkt</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="{{ route('admin.product.store') }}" method="post" type="" class="form-horizontal" enctype="multipart/form-data">

                @csrf
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="name">Nazwa <span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name ?? '') }}">

                        @if($errors->has('name'))
                            <p class="alert alert-danger"> {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group col-md-5">
                        <label for="description">Opis <span class="required">*</span></label>
                        <textarea name="description" id="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
                        @if($errors->has('description'))
                            <p class="alert alert-danger"> {{ $errors->first('description') }}
                            </p>
                        @endif
                    </div>


                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="amount">Ilość <span class="required">*</span></label>
                        <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount', $product->amount ?? '') }}">

                        @if($errors->has('title'))
                            <p class="alert alert-danger"> {{ $errors->first('title') }}
                            </p>
                        @endif
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
                                <button type="submit" class="btn btn-success">Dodaj produkt</button>
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