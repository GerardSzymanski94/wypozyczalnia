@extends('admin.app')

@section('content')

    <div class="x_panel">
        <div class="x_title">
            <h2>Przedłuż wypożyczenie</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="{{ route('admin.orderproduct.extension_save', ['orderProduct'=>$orderProduct->id]) }}"
                  method="post" type=""
                  class="form-horizontal"
                  enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="order_id" value="{{ $orderProduct->order->id }}">
                <input type="hidden" name="order_product_id" value="{{ $orderProduct->id }}">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="days">Ilość dni <span class="required">*</span></label>
                        <input type="number" name="days" id="days" class="form-control">

                        @if($errors->has('days'))
                            <p class="alert alert-danger"> {{ $errors->first('days') }}
                            </p>
                        @endif
                    </div>
                </div>
                <hr>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button type="submit" class="btn btn-success">Zapisz</button>
                            </div>
                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <a href="{{ route('admin.order.index') }}" class="btn btn-primary">Anuluj</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection