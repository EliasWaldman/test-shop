@extends('layouts.app')
@section('content')
@include('partials.breadcrumbs')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h1 class="card-title">{{ $product->name }}</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('/img/demo.jpg'.$product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                            </div>
                            <div class="col-md-6 props-block">
                                <div class="card-text border-bottom pb-3 mb-3">
                                    <h2>Описание</h2>
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div class="card-text">
                                    <h2>Цена</h2>
                                    <p>{{ $product->getLattestPriceAttribute()->price }} ₽</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
