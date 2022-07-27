@extends('layouts.app')
@section('content')
    <h1>Welcome</h1>
    {{-- <p>Let's start.</p> --}}
    @empty($products)
        <div class="alert alert-danger">
            No Products yet!
        </div>
    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-3">
                    {{-- @include('components.product-card', ['test' => 'testing']) --}}
                    @include('components.product-card')
                </div>
            @endforeach
        </div>
    @endempty
@endsection
