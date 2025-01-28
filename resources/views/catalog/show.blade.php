@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
                @if($loop->first)
                    <!-- Добавим отладку для первой крошки -->
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->name }} </a></li>
                @elseif($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->name }}</li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb->url }}"> {{ $breadcrumb->name }} </a>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>

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
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-3">
            <form method="get" class="d-flex justify-content-between align-items-center w-100 sorting">
                <label for="sort" class="me-2 mb-0">Сортировать по:</label>
                <select name="sort" id="sort" class="form-select w-75 w-sm-auto" onchange="this.form.submit()">
                    <option value="" {{ request('sort') === '' ? 'selected' : '' }}>По умолчанию</option>
                    <option value="price" {{ request('sort') === 'price' ? 'selected' : '' }}>От дешевых к дорогим</option>
                    <option value="-price" {{ request('sort') === '-price' ? 'selected' : '' }}>От дорогих к дешевым</option>
                    <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>По наименованию</option>
                    <option value="-name" {{ request('sort') === '-name' ? 'selected' : '' }}>По наименованию в обратном порядке</option>
                </select>
            </form>
        </div>
    </div>


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
