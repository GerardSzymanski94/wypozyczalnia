@extends('admin.app')

@section('content')

    <div class="x_panel">
        <div class="x_title">
            <h2>Dodaj metodę dostawy</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="{{ route('admin.delivery.store') }}" method="post" type="" class="form-horizontal"
                  enctype="multipart/form-data">

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
                               value="{{ old('name', $delivery->name ?? '') }}">

                        @if($errors->has('name'))
                            <p class="alert alert-danger"> {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>


                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price">Cena <span class="required">*</span></label>
                        <input type="integer" name="price" id="price" class="form-control"
                               value="{{ old('price', $delivery->price ?? '') }}">

                        @if($errors->has('price'))
                            <p class="alert alert-danger"> {{ $errors->first('price') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="additional">Dodatkowe pole <span class="required"></span></label>
                        <input type="text" name="additional" id="additional" class="form-control"
                               value="{{ old('additional', $delivery->additional ?? '') }}">

                        @if($errors->has('additional'))
                            <p class="alert alert-danger"> {{ $errors->first('additional') }}
                            </p>
                        @endif
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="baselinker_id">ID produktu w Baselinker <span
                                    class="required"></span></label>
                        <input type="text" name="baselinker_id" id="baselinker_id"
                               class="form-control"
                               value="{{ old('baselinker_id', $delivery->baselinker_id ?? '') }}">

                        @if($errors->has('baselinker_id'))
                            <p class="alert alert-danger"> {{ $errors->first('baselinker_id') }}
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
                        <input type="file" class="form-control-file" name="icon" id="photo">

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button type="submit" class="btn btn-success">Dodaj</button>
                            </div>
                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <a href="{{ route('admin.delivery.index') }}" class="btn btn-primary">Anuluj</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection