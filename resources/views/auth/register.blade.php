@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- <div class="card shadow mt-5">
                <div class="card-header text-light" style="background-color: blue">{{ __('REGISTER') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <label for="" class="text-dark">You are a member <a class="text-primary" href="{{route('login')}}">Login</a></label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
                <section class="vh-100">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col col-xl-10">
                                <div class="card" style="border-radius: 1rem;">
                                    <div class="row g-0">
                                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                                            <img src="https://www.allen.ac.in/apps2324/assets/images/login.jpg"
                                                alt="login form" class="img-fluid d-flex item-align"
                                                style="height: 670px;;border-radius: 1rem 0 0 1rem;" />
                                        </div>
                                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                            <div class="card-body p-4 p-lg-5 text-black">
                                                <form method="POST" action="{{ route('register') }}">
                                                    @csrf
                                                    <div class="d-flex align-items-center mb-3 pb-1">
                                                        <i class="fa fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                                        <span class="h1 fw-bold mb-0">Welcome to Again !</span>
                                                    </div>

                                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register
                                                        your account</h5>

                                                    <div class="form-outline mb-4">
                                                        <input type="text" id="name" name="name"
                                                            value="{{ old('name') }}" required autocomplete="name"
                                                            autofocus
                                                            class="form-control form-control-lg @error('name') is-invalid @enderror" />
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label class="form-label" for="form2Example17">Name</label>
                                                    </div>

                                                    <div class="form-outline mb-4">

                                                        <input type="email" id="email" name="email"
                                                            value="{{ old('email') }}" required autocomplete="email"
                                                            autofocus
                                                            class="form-control form-control-lg @error('email') is-invalid @enderror" />
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label class="form-label" for="form2Example17">Email address</label>
                                                    </div>

                                                    <div class="form-outline mb-4">

                                                        <input type="password" name="password" required
                                                            autocomplete="new-password"
                                                            class="form-control form-control-lg @error('password') is-invalid @enderror" />

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label class="form-label" for="form2Example27">Password</label>
                                                    </div>

                                                    <div class="form-outline mb-4">
                                                        <input type="password" id="password-confirm"
                                                            name="password_confirmation" required
                                                            autocomplete="new-password"
                                                            class="form-control form-control-lg " />
                                                        <label class="form-label" for="form2Example17">Confirm
                                                            Password</label>
                                                    </div>

                                                    <div class="pt-1 mb-4">
                                                        <button class="btn btn-dark btn-lg btn-block"
                                                            type="submit">{{ __('Register') }}</button>
                                                    </div>
                                                    <p class="mb-3 pb-lg-2" style="color: #393f81;">Do have an account?
                                                        <a href="{{ route('login') }}" style="color: #393f81;">Login
                                                            here</a>
                                                    </p>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
