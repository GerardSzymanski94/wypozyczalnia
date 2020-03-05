@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($order->orderProducts() as $item)
                    @foreach($item as $product)
                        <div class="col-md-12">{{ $product->product->name }} {{ $product->amount }}</div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

@endsection
