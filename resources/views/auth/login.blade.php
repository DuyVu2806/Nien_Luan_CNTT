@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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

                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="d-flex align-items-center mb-3 pb-1">
                                                        <i class="fa fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                                        <span class="h1 fw-bold mb-0">Welcome to Again !</span>
                                                    </div>

                                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into
                                                        your account</h5>

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
                                                            autocomplete="current-password"
                                                            class="form-control form-control-lg @error('password') is-invalid @enderror" />

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label class="form-label" for="form2Example27">Password</label>
                                                    </div>

                                                    <div class="pt-1 mb-4">
                                                        <button class="btn btn-dark btn-lg btn-block"
                                                            type="submit">{{ __('Login') }}</button>
                                                    </div>
                                                    <p class="mb-3 pb-lg-2" style="color: #393f81;">Don't have an account?
                                                        <a href="{{route('register')}}" style="color: #393f81;">Register here</a>
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
