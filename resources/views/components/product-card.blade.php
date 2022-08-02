<div class="card">
    <img class="card-img-top" src="{{ asset($product->images->first()->path) }}" alt="" height="500">
    <div class="card-body">
        <h5 class="text-right"><strong>${{ $product->price }}</strong></h5>
        <h4 class="card-title">{{ $product->title }}</h4>
        <p class="card-text">{{ $product->description }}</p>
        <p class="card-text"><strong>{{ $product->stock }} left</strong></p>
    </div>
</div>
{{-- <h1>{{ $product->title }} ({{ $product->id }})</h1>
<p>{{ $product->description }}</p>
<p>{{ $product->price }}</p>
<p>{{ $product->stock }}</p>
<p>{{ $product->status }}</p> --}}
