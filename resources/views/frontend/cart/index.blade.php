@extends('layouts.app')

@section('title', 'Cart List')

@section('style')
    <style>
        .bg-grey {
            background-color: #34ffff80
        }

        .prodname {
            white-space: nowrap;
            width: 160px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media (min-width: 992px) {
            .card-registration-2 .bg-grey {
                border-top-right-radius: 16px;
                border-bottom-right-radius: 16px;
            }
        }

        @media (max-width: 991px) {
            .card-registration-2 .bg-grey {
                border-top-left-radius: 16px;
                border-bottom-left-radius: 16px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="py-3 py-md-2 bg-light">
        <div class=" py-3">
            <livewire:frontend.cart.cart-show>
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
