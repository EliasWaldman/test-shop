@extends('layouts.app')
@section('content')

    <div class="container">
        <h1 class="title">Товары</h1>

        <div class="row">
            <div class="col-md-12 mb-3">
                <form method="get" class="d-flex justify-content-start sorting">
                    <label for="sort" class="me-2">Сортировать по:</label>
                    <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                        <option value="" {{ request('sort') === '' ? 'selected' : '' }}>По умолчанию</option>
                        <option value="price" {{ request('sort') === 'price' ? 'selected' : '' }}>От дешевых к дорогим</option>
                        <option value="-price" {{ request('sort') === '-price' ? 'selected' : '' }}>От дорогих к дешевым</option>
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>По наименованию</option>
                        <option value="-name" {{ request('sort') === '-name' ? 'selected' : '' }}>По наименованию в обратном порядке</option>
                    </select>
                </form>
            </div>
        </div>


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
