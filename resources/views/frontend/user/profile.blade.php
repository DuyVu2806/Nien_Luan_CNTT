@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="py-3 py-md-2 bg-light">
        <div class="mt-2 py-3">
            <div class="col-md-12">
                <h4 class="mb-4">My Profile</h4>
                <hr>
            </div>
            @if (session('message'))
                {{ session('message') }}
            @endif

            <form action="{{ url('profile') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="ml-3">
                            <img src="{{asset('uploads/profile/avatar.png')}}" alt="" width="100%" height="300px">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mr-1">

                            <div class="mb-2">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}"
                                    readonly>
                            </div>
                            <div class="mb-2">
                                <label for="">Phone</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ Auth::user()->UserDetail->phone ?? '' }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">PinCode</label>
                                <input type="text" class="form-control" name="pincode"
                                    value="{{ Auth::user()->UserDetail->pincode ?? '' }}">
                                @error('pincode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="">Address</label>
                                <input type="text" class="form-control" name="address"
                                    value="{{ Auth::user()->UserDetail->address ?? '' }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
