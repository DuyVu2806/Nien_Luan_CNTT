@extends('layouts.app')

@section('title', 'All Product')

@section('content')
    <div class="py-3 py-md-2 bg-light">
        <div class=" py-3">
            <div class="col-md-12">
                <h4 class="mb-4">All Products</h4>
                <livewire:frontend.product.all-product>
            </div>
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
