@extends('layouts.app')

@section('title', 'Product')


@section('style')
    <style>
        .product-card {
            background-color: #fff;
            border: 1px solid #ccc;
            margin-bottom: 24px;
        }

        .product-card a {
            text-decoration: none;
        }

        .product-card .stock {
            position: absolute;
            color: #fff;
            border-radius: 4px;
            padding: 2px 12px;
            margin: 8px;
            font-size: 12px;
        }

        .product-card .product-card-img {
            max-height: 260px;
            overflow: hidden;
            border-bottom: 1px solid #ccc;
        }

        .product-card .product-card-img img {
            width: 100%;
            min-height: 260px;
            height: 100%;
        }

        .product-card .product-card-body {
            padding: 10px 10px;
        }

        .product-card .product-card-body .product-brand {
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 4px;
            color: #937979;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .product-card .product-card-body .product-name {
            font-size: 20px;
            font-weight: 600;
            color: #000;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .product-card .product-card-body .selling-price {
            font-size: 22px;
            color: #000;
            font-weight: 600;
            margin-right: 8px;
        }

        .product-card .product-card-body .original-price {
            font-size: 18px;
            color: #937979;
            font-weight: 400;
            text-decoration: line-through;
        }

        .product-card .product-card-body .btn1 {
            border: 1px solid;
            margin-right: 3px;
            font-size: 12px;
            margin-top: 10px;
        }

        .product-card .product-card-body .btn2 {
            border: 1px solid;
            margin-right: 3px;
            font-size: 12px;
            margin-top: 10px;
        }

        .btn2:hover {
            background-color: #ff0000;
            color: #fff;
        }

        .btn1:hover {
            background-color: #2874f0;
            color: #fff;
        }
    </style>
@endsection


@section('content')
    <div class="py-3 py-md-2 bg-light">
        <div class=" py-3">
            <div class="col-md-12">
                <h4 class="mb-4">Our Products</h4>
            </div>
            <livewire:frontend.product.index :category="$category">
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.addEventListener('message', event => {
            Swal.fire({
                position: 'center',
                icon: event.detail.type,
                title: event.detail.text,
                showConfirmButton: false,
                timer: 1500
            })
        });
    </script>
@endsection
