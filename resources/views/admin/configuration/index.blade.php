@extends('admin.app')

@section('content')

    @if(\Illuminate\Support\Facades\Session::has('message'))

        <div class="alert alert-success">
            {{ \Illuminate\Support\Facades\Session::get('message') }}
        </div>
    @endif
    <div class="x_panel">
        <div class="x_title">
            <h2>Konfiguracja API</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="{{ route('admin.configuration.store') }}" method="post" type="" class="form-horizontal"
                  enctype="multipart/form-data">

                @csrf

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h2></h2>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="turn_on_baselinker">Włącz/Wyłącz komunikacje z API <span
                                    class="required">*</span></label>
                        <input type="checkbox" name="turn_on_baselinker" id="turn_on_baselinker" class="checkbox"
                               @if($conf->turn_on_baselinker == 1) checked @endif>

                        @if($errors->has('turn_on_baselinker'))
                            <p class="alert alert-danger"> {{ $errors->first('turn_on_baselinker') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="baselinker_key">Klucz API <span class="required">*</span></label>
                        <input type="text" name="baselinker_key" id="baselinker_key" class="form-control"
                               value="{{ old('baselinker_key', $conf->baselinker_key ?? '') }}">
                        @if($errors->has('baselinker_key'))
                            <p class="alert alert-danger"> {{ $errors->first('baselinker_key') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="status_id">ID statusu do API <span class="required">*</span></label>
                        <input type="text" name="status_id" id="status_id" class="form-control"
                               value="{{ old('status_id', $conf->status_id ?? '') }}">
                        @if($errors->has('status_id'))
                            <p class="alert alert-danger"> {{ $errors->first('status_id') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="baselinker_deposit_id">ID kaucji w Baselinker <span
                                    class="required">*</span></label>
                        <input type="text" name="baselinker_deposit_id" id="baselinker_deposit_id" class="form-control"
                               value="{{ old('baselinker_deposit_id', $conf->baselinker_deposit_id ?? '') }}">
                        @if($errors->has('baselinker_deposit_id'))
                            <p class="alert alert-danger"> {{ $errors->first('baselinker_deposit_id') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button type="submit" class="btn btn-success">Zapisz</button>
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