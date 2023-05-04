@extends('layouts.app')

@section('title', 'Thank you')

@section('content')
    <div class="card shadow m-2">
        <div class="card-body p-md-5 text-center">
            <h4>Thank you for Shopping With My Shop</h4>
            <a class="btn btn-info" href="{{ url('/collections') }}">Show now</a>
        </div>
    </div>
@endsection
