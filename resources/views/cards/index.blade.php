@extends('layouts.app')
@section('content')
    <h1>Your Carts</h1>
    {{-- <p>Let's start.</p> --}}
    @if($card->products->isEmpty())
        <div class="alert alert-warning">
            Your cart is empty
        </div>
    @else
        <div class="row">
            @foreach ($card->products as $product)
                <div class="col-3">
                    @include('components.product-card')
                </div>
            @endforeach
        </div>
    @endif
@endsection
