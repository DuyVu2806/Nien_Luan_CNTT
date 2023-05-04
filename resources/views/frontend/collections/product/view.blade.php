@extends('layouts.app')

@section('title', 'Product')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/frontend/thumbnailSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend/comment.css') }}">
    <style>
        .product-view .product-name {
            font-size: 24px;
            color: #2874f0;
        }

        .product-view .product-name .label-stock {
            font-size: 13px;
            padding: 4px 13px;
            border-radius: 5px;
            color: #fff;
            box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
            float: right;
        }

        .product-view .product-path {
            font-size: 13px;
            font-weight: 500;
            color: #252525;
            margin-bottom: 16px;
        }

        .product-view .selling-price {
            font-size: 26px;
            color: #000;
            font-weight: 600;
            margin-right: 8px;
        }

        .product-view .original-price {
            font-size: 18px;
            color: #937979;
            font-weight: 400;
            text-decoration: line-through;
        }

        .product-view .btn1,
        .btn2 {
            border: 1px solid;
            margin-right: 3px;
            font-size: 14px;
            margin-top: 10px;
        }

        .product-view .btn1:hover {
            background-color: #2874f0;
            color: #fff;
        }

        .product-view .btn2:hover {
            background-color: #ff0000;
            color: #fff;
        }

        .product-view .input-quantity {
            border: 1px solid #000;
            margin-right: 3px;
            font-size: 12px;
            margin-top: 10px;
            width: 58px;
            outline: none;
            text-align: center;
        }
    </style>
@endsection

@section('content')

    <div>
        <livewire:frontend.product.view :category="$category" :product="$product" :review="$review" :reviewcount="$reviewcount" :listReplyComment="$listReplyComment" />
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
    <script>
        let sliderImages = document.querySelectorAll(".slider > div");
        let sliderNav = document.querySelectorAll(".slider-nav img");
        let currentIndex = 0;

        function reset() {
            for (let i = 0; i < sliderImages.length; i++) {
                sliderImages[i].style.opacity = 0;
                sliderNav[i].classList.remove("active");
            }
        }

        function startSlide() {
            reset();
            sliderImages[0].style.opacity = 1;
            sliderNav[0].classList.add("active");
        }

        function currentSlide(n) {
            reset();
            currentIndex = n - 1;
            sliderImages[currentIndex].style.opacity = 1;
            sliderNav[currentIndex].classList.add("active");
        }

        // setInterval(() => {
        //     moveNext();
        // }, 5000);

        startSlide();
    </script>
@endsection
