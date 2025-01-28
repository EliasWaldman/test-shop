@extends('layouts.app')
@section('content')

    <div class="container">
        <h1 class="title">Товары</h1>
        @include('partials.sort')
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h5>
                            <p class="card-text">Цена: {{ $product->getLattestPriceAttribute()->price }} ₽</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="paginate">
            {{ $products->links() }}
        </div>
    </div>
@endsection
