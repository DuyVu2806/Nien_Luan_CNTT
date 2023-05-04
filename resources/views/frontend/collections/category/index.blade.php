@extends('layouts.app')

@section('title', 'Category')

<style>
    .category-card {
        border: 1px solid #ddd;
        box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
        margin-bottom: 24px;
        background-color: #fff;
    }

    .category-card a {
        text-decoration: none;
    }

    .category-card .category-card-img {
        max-height: 260px;
        height: 100%;
        overflow: hidden;
        border-bottom: 1px solid #ccc;
    }

    .category-card .category-card-body {
        padding: 10px 16px;
    }

    .category-card .category-card-body h5 {
        margin-bottom: 0px;
        font-size: 18px;
        font-weight: 600;
        color: #000;
        text-align: center;
    }
</style>
@section('content')
    <div class="py-3 py-md-2 bg-light">
        <div class="container mt-2 py-3">
            <h4>Catgory Page</h4>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-6 col-md-3">
                        <div class="category-card shadow">
                            <a href="{{ url('collections/' . $category->slug) }}">
                                <div class="category-card-img">
                                    <img src="{{ asset('uploads/category/' . $category->image) }}" class="w-100 h-100"
                                        alt="Laptop">
                                </div>
                                <div class="category-card-body">
                                    <h5>{{ $category->name }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
