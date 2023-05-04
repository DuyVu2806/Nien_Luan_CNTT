@extends('layouts.app')

@section('title', 'Checkout')

@section('style')
    <style>
        .prodname {
            white-space: nowrap;
            width: 160px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection

@section('content')
    <div class="py-3 py-md-2 bg-light">
        <div class="mt-2 py-3">
            <h4>Checkout Page</h4>
            <hr>
            <livewire:frontend.checkout.checkout-show>
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
