<div class="container">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
            <div class="card card-registration card-registration-2 shadow" style="border-radius: 15px;">
                <div class="card-body p-0" style="margin: 0 0.9em; ">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="p-5">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                    <h6 class="mb-0 text-muted">{{ $cart->count() }} items</h6>
                                </div>
                                <hr class="my-4">
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @forelse ($cart as $cartItem)
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="{{ $cartItem->product->productImages[0]->image }}"
                                                class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3 ">
                                            <h6 class="prodname">
                                                <a
                                                    href="{{ url('collections/' . $cartItem->product->category->slug . '/' . $cartItem->product->slug) }}"class="text-info">{{ $cartItem->product->name }}</a>
                                            </h6>
                                            @if (isset($cartItem->productColor))
                                                <div
                                                    style=" width: 30px; height: 30px; background-color: {{ $cartItem->productColor->color->code }};">
                                                </div>
                                            @else
                                                @foreach ($cartItem->product->productColors as $item)
                                                    <div
                                                        style=" width: 30px; height: 30px; background-color: {{ $item->color->code }};">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">

                                            <button type="button" wire:loading.attr='disabled'
                                                wire:click='minusQty({{ $cartItem->id }})' class="btn btn-link px-2"><i
                                                    class="fa fa-minus"></i>
                                            </button>

                                            <input type="text" value="{{ $cartItem->quantity }}"
                                                class="input-quantity form-control form-control-sm text-center"
                                                style="width: 50px;" disabled />

                                            <button type="button" wire:loading.attr='disabled'
                                                wire:click='plusQty({{ $cartItem->id }})' class="btn btn-link px-2"><i
                                                    class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1">
                                            <h6 class="mb-0">$ {{ $cartItem->product->selling_price }}</h6>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="#!" class="text-danger" wire:loading.attr='disabled'
                                                wire:click='removeCartItem({{ $cartItem->id }})'><i
                                                    class="fa fa-times"></i></a>
                                        </div>

                                        <div class="col-md-1 my-auto">
                                            <label for="checkItem">
                                                <input style="width:15px; height:15px;margin-top:1rem" type="checkbox"
                                                    wire:model="carts.{{ $cartItem['id'] }}.checkItem"
                                                    wire:click="updateSelections({{ $cartItem['id'] }})"
                                                    name="checkItem" value="1"
                                                    {{ $carts[$cartItem['id']]['checkItem'] ? 'checked' : '' }}>
                                            </label>
                                        </div>

                                    </div>
                                    <hr class="my-4">
                                    @php
                                        if ($cartItem->checkItem == 1) {
                                            $totalPrice += $cartItem->product->selling_price * $cartItem->quantity;
                                        }
                                    @endphp
                                @empty
                                <h4>No product added</h4>
                                @endforelse
                                <div class="pt-5">
                                    <h6 class="mb-0"><a href="{{url('/collections')}}" class="text-info">Back to shop</a>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 bg-grey"
                            style="border-top-right-radius: 16px;border-bottom-right-radius: 16px;">
                            <div class="p-5">
                                <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                <hr class="my-4">
                                <div class="d-flex justify-content-between mb-5">
                                    <h5 class="text-uppercase">Total price</h5>
                                    <h5>${{ $totalPrice }}</h5>
                                </div>
                                @if ($cartCount != 0)
                                    <a class="btn btn-lg btn-warning btn-block w-100 text-light"
                                        href="{{ url('/checkout') }}">Checkout</a>
                                @else
                                    <a class="btn btn-lg btn-warning btn-block w-100 text-light disabled"
                                        href="{{ url('/checkout') }}">Checkout</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
