@extends('admin.app')

@section('content')

    <div class="x_panel">
        <div class="x_title">
            <h2>Edycja zamówienia</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="{{ route('admin.order.update',['order'=>$order->id]) }}" method="post" type=""
                  class="form-horizontal"
                  enctype="multipart/form-data">

                @csrf

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <h2>Dane o zamówieniu</h2>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">

                        <label for="date_from">Nowa data początkowa (obecnie: {{ $order->date_from }})<span
                                    class="required">*</span></label>
                        <input type="datetime-local" name="date_from" id="date_from" class="form-control">

                        @if($errors->has('date_from'))
                            <p class="alert alert-danger"> {{ $errors->first('date_from') }}
                            </p>
                        @endif
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button type="submit" class="btn btn-success">Edytuj</button>
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