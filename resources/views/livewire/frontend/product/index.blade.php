<div class="row">
    <div class="col-md-3">
        <div class="card ml-1">
            <div class="card-header">
                <h4>Brand</h4>
            </div>
            <div class="card-body">
                @forelse ($category->brands as $branditem)
                    <label class="d-block">
                        <input type="checkbox" wire:model="brandInputs" value="{{ $branditem->id }}">
                        {{ $branditem->name }}
                    </label>
                @empty
                    <label class="d-block">No Brand</label>
                @endforelse

            </div>
        </div>

        <div class="card mt-3 ml-1">
            <div class="card-header">
                <h4>Price</h4>
            </div>
            <div class="card-body">
                <label class="d-block">
                    <input type="radio" name="priceSort" wire:model="priceInputs" value="high-to-low"> High to low
                </label>
                <label class="d-block">
                    <input type="radio" name="priceSort" wire:model="priceInputs" value="low-to-high"> Low to high
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        @forelse ($products as $product)
            <div class="row justify-content-center mb-3">
                <div class="col-md-12 col-xl-10">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                        <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" />
                                        <a href="#!" style="position: absolute;top: 0;left: 0;">
                                            <div class="mask">
                                                <div class="d-flex justify-content-start align-items-end h-100">
                                                    @if ($product->quantity > 0)
                                                        <h5><span class="badge bg-success ms-2 text-light">In
                                                                Stock</span></h5>
                                                    @else
                                                        <h5><span class="badge bg-danger ms-2 text-light">Out Of
                                                                Stock</span></h5>
                                                    @endif

                                                </div>
                                            </div>

                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <h5>{{ $product->name }}</h5>
                                    <div class="d-flex flex-row">
                                        <div class="text-danger mb-1 me-2">
                                            @php
                                                $rating = $product->rating;
                                                $full_stars = floor($rating);
                                                $half_stars = round($rating - $full_stars, 1) * 10;
                                            @endphp
                                            <span class="stars" style="color: #F39C12">
                                                @for ($i = 0; $i < $full_stars; $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                                @if ($half_stars > 0)
                                                    <i class="fa fa-star-half"></i>
                                                @endif
                                                @if ($rating == 5 || $rating == 4.5)
                                                    @for ($i = $full_stars + 1; $i < 5; $i++)
                                                        <i class="fa fa-star-o"></i>
                                                    @endfor
                                                @else
                                                    @for ($i = $full_stars + 0; $i < 5; $i++)
                                                        <i class="fa fa-star-o"></i>
                                                    @endfor
                                                @endif

                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-1 mb-0 text-muted small">
                                        <span class="text-primary"> • </span>
                                        <span>Category:</span>
                                        <span>{{ $product->category->name }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                    <div class="d-flex flex-row align-items-center mb-1">
                                        <h4 class="mb-1 me-1">${{ $product->selling_price }}</h4>&nbsp;
                                        <span class="text-danger"><s>${{ $product->original_price }}</s></span>
                                    </div>
                                    <h6 class="text-success">Free shipping</h6>
                                    <div class="d-flex flex-column mt-4">
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ url('collections/' . $product->category->slug . '/' . $product->slug) }}">Details</a>
                                        <button wire:click="addToWishList({{ $product->id }})"
                                            class="btn btn-outline-danger btn-sm mt-2">
                                            <span wire:loading.remove wire:target='addToWishList'>
                                                <i class="fa fa-heart"></i>
                                            </span>
                                            <span wire:loading wire:target='addToWishList'>
                                                Adding...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h3>No Products Ivailable For {{ $category->name }}</h3>
        @endforelse

    </div>
    {{-- <div class="col-md-9">
        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-card-img">
                            @if ($product->quantity > 0)
                                <label class="stock bg-success">In Stock</label>
                            @else
                                <label class="stock bg-danger">Out Of Stock</label>
                            @endif
                            <img src="{{ asset($product->productImages[0]->image) }}" alt="Laptop">
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{ $product->brand->name }}</p>
                            <h5 class="product-name">
                                <a href="{{ url('collections/' . $product->category->slug . '/' . $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <div>
                                <span class="selling-price">${{ $product->selling_price }}</span>
                                <span class="original-price">${{ $product->original_price }}</span>
                            </div>
                            <div class="mt-2">
                                <a href="{{url('collections/'.$product->category->slug.'/'.$product->slug)}}" class="btn btn1">Add To Cart</a>
                                <button wire:click="addToWishList({{ $product->id }})" class="btn btn2">
                                    <span wire:loading.remove wire:target='addToWishList'>
                                        <i class="fa fa-heart"></i>
                                    </span>
                                    <span wire:loading wire:target='addToWishList'>
                                        Adding...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h3>No Products Ivailable For {{ $category->name }}</h3>
            @endforelse
        </div>

    </div> --}}
</div>
