@extends('layouts.app')

@section('title', 'Search Page')

@section('style')

@endsection

@section('content')
    <div class="py-3 py-md-2 bg-light">
        <div class="container mt-2 py-3">
            @if (count($products) > 0)
                <h3>Kết quả tìm kiếm cho "{{ $query }}"</h3>
                @foreach ($products as $product)
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-12 col-xl-10">
                            <div class="card shadow-0 border rounded-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                            <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                                <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" />
                                                <a href="#!" style="position: absolute;top: 0;left: 0;">
                                                    <div class="mask">
                                                        <div class="d-flex justify-content-start align-items-end h-100">
                                                            @if ($product->quantity > 0)
                                                                <h5><span class="badge bg-success ms-2 text-light">In
                                                                        Stock</span></h5>
                                                            @else
                                                                <h5><span class="badge bg-danger ms-2 text-light">Out Of
                                                                        Stock</span></h5>
                                                            @endif

                                                        </div>
                                                    </div>

                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <h5>{{ $product->name }}</h5>
                                            <div class="d-flex flex-row">
                                                <div class="text-danger mb-1 me-2">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="mt-1 mb-0 text-muted small">
                                                <span class="text-primary"> • </span>
                                                <span>Category:</span>
                                                <span>{{ $product->category->name }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                            <div class="d-flex flex-row align-items-center mb-1">
                                                <h4 class="mb-1 me-1">${{ $product->selling_price }}</h4>&nbsp;
                                                <span class="text-danger"><s>${{ $product->original_price }}</s></span>
                                            </div>
                                            <h6 class="text-success">Free shipping</h6>
                                            <div class="d-flex flex-column mt-4">
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ url('collections/' . $product->category->slug . '/' . $product->slug) }}">Details</a>
                                                <button wire:click="addToWishList({{ $product->id }})"
                                                    class="btn btn-outline-danger btn-sm mt-2">
                                                    <span wire:loading.remove wire:target='addToWishList'>
                                                        <i class="fa fa-heart"></i>
                                                    </span>
                                                    <span wire:loading wire:target='addToWishList'>
                                                        Adding...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3>Không tìm thấy sản phẩm nào phù hợp với "{{ $query }}"</h3>
            @endif
        @endsection
    </div>
</div>
