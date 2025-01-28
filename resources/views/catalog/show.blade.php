@extends('layouts.app')
@section('content')

    @include('partials.breadcrumbs')
    <h2>{{ $group->name }}</h2>
    <!-- Подгруппы -->
    <h3>Подгруппы:</h3>
    <div class="mb-4">
        @foreach($subgroups as $subgroup)
            <a href="{{ route('catalog.show', $subgroup->id) }}" class="text-decoration-none me-3">
                <span class="subgroup-name">{{ $subgroup->name }}</span>
                ({{ $subgroup->getTotalProductsCount() }})
            </a>
        @endforeach
    </div>
    @include('partials.sort')
    <!-- Товары -->
    <h3>Товары:</h3>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                <span class="product-name">{{ $product->name }}</span>
                            </a>
                        </h5>
                        <p class="card-text">Цена: {{ $product->getLattestPriceAttribute()->price }} ₽</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $products->links() }}

@endsection
