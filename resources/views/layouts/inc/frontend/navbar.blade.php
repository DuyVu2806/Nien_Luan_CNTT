<style>
    nav {
        position: fixed;
        top: 0.5rem;
    }

    nav.scrolled {
        top: 0;
        position: fixed;
        width: 100%;
    }
</style>
<script>
    window.addEventListener('scroll', function() {
        var nav = document.querySelector('nav');
        nav.classList.toggle('scrolled', window.scrollY > 15);
    });
</script>
<section class="ftco-section ">
    <div class="container-fluid px-md-5">
        <div class="row justify-content-between">
            <div class="col-md-8 order-md-last">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <a class="navbar-brand" href="/">DV Store <span>Ecommerce</span></a>
                    </div>
                    <div class="col-md-6 d-md-flex justify-content-end mb-md-0 mb-3">
                        <form action="{{ url('/search') }}" class="searchform order-lg-last">
                            <div class="form-group d-flex">
                                <input type="text" name="query" class="form-control pl-3 " placeholder="Search">
                                <button type="submit" placeholder="" class="form-control search"><span
                                        class="fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="social-media">
                    <p class="mb-0 d-flex">
                        <a href="#" class="d-flex align-items-center justify-content-center"><span
                                class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><span
                                class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><span
                                class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><span
                                class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item "><a href="/" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Page</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="{{ url('/collections') }}">All Category</a>
                            <a class="dropdown-item" href="{{ url('/all-product') }}">All Product</a>
                        </div>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item ms-3">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                        @php
                            $name = Auth::user()->name;
                            $name_parts = explode(' ', $name);
                            $last_two_parts = array_slice($name_parts, count($name_parts) - 2);
                            $last_two = implode(' ', $last_two_parts);
                        @endphp
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">{{ $last_two }}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                @if (!Auth::user()->status)
                                    <a class="dropdown-item" href="{{ url('/profile') }}">Profile</a>
                                @endif

                                <a class="dropdown-item" href="{{ url('/wishlist') }}">Wishlist (
                                    <livewire:frontend.wishlist-count />)
                                </a>
                                <a class="dropdown-item" href="{{ url('/order') }}">My Order (
                                    <livewire:frontend.my-order.my-order-count />)
                                </a>
                                <a class="dropdown-item" href="{{ url('/change-password') }}">Change Password
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

                    <li class="nav-item"><a href="{{ url('cart') }}" class="nav-link">Cart(
                            <livewire:frontend.cart.cart-count>)
                        </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
</section>
