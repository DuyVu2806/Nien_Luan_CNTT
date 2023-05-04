@extends('layouts.app')

@section('title', 'WishList')

@section('style')
    <style>
        .btn1 {
            border: 1px solid;
            border-radius: 0px 50% 50% 0;
            font-size: 10px;
        }

        .btn2 {
            border: 1px solid;
            border-radius: 50% 0 0 50%;
            font-size: 10px;
        }

        .btn1:hover,
        .btn2:hover {
            background-color: #2874f0;
            color: #fff;
        }

        .input-quantity {
            border: 1px solid #000;
            font-size: 12px;
            width: 25%;
            outline: none;
            text-align: center;
        }

        /* Cart or Wishlist */
        .shopping-cart .cart-header {
            padding: 10px;
        }

        .shopping-cart .cart-header h4 {
            font-size: 18px;
            margin-bottom: 0px;
        }

        .shopping-cart .cart-item a {
            text-decoration: none;
        }

        .shopping-cart .cart-item {
            background-color: #fff;
            box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
            padding: 10px 10px;
            margin-top: 10px;
        }

        .shopping-cart .cart-item .product-name {
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            cursor: pointer;
        }

        .shopping-cart .cart-item .price {
            font-size: 16px;
            font-weight: 600;
            padding: 4px 2px;
        }
    </style>
@endsection

@section('content')
    <div class="py-3 py-md-2 bg-light">
        <div class="mt-2 py-3">
            <livewire:frontend.wishlist-show>
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
