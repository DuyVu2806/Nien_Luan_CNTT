@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

    <div class="py-3 py-md-2 bg-light">
        @if (session('message'))
            <span class="alert alert-success"> {{session('message')}}</span>
        @endif
        
        <div class="mt-5 py-3">
            
            <div class="card" style="margin: 0 17rem">
                <div class="card-header bg-info">
                    <h4 class="text-center text-white">Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('/change-password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="">Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                            @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">New Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Comfirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection