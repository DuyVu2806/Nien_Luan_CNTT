<div>
    @if ($this->cartCount == 0)
        <div class="card shadow m-2">
            <div class="card-body p-md-5">
                <h4 class="text-center">No Item In Cart to Checkout</h4>
                <a class="col-md-12 btn btn-info mb-2 p-2" href="{{ url('/cart') }}">Cart Now</a>
                <a class="col-md-12 btn btn-warning mb-2 p-2" href="{{ url('/collections') }}">Show Now</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-7">
                <div class="card ml-1 mb-5">
                    <div class="card-body ">
                        <h6>Information</h6>
                        <hr>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-4">
                                <label for="">Fullname</label>
                                <input type="text" required id="fullname" wire:model="fullname"
                                    class="form-control">
                                @error('fullname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="">Email Address</label>
                                <input type="text" required id="email" wire:model="email" class="form-control">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="">Phone Number</label>
                                <input type="number" required id="phone" wire:model="phone" class="form-control">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="">Pin code</label>
                                <input type="text" id="pincode" wire:model="pincode" class="form-control">
                                @error('pincode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="">Full Address</label>
                                <textarea id="address" wire:model="address" rows="4" class="form-control"></textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card mr-1">
                    <div class="card-body">
                        <h6>Product Information</h6>
                        <hr>
                        @php
                            $total_price = 0;
                        @endphp
                        <div class="row text-dark mb-1 font-weight-bold">
                            <div class="col-md-6">
                                Product
                            </div>
                            <div class="col-md-3">
                                Quantity
                            </div>
                            <div class="col-md-3">
                                Price
                            </div>
                        </div>
                        <div class="row text-dark mb-1">
                            @foreach ($carts as $cartItem)
                                <div class="col-md-6 ">
                                    <a
                                        href="{{ url('collections/' . $cartItem->product->category->slug . '/' . $cartItem->product->slug) }}">
                                        <label class="prodname">
                                            <img width="30px" height="30px"
                                                src="{{ $cartItem->product->productImages[0]->image }}" alt="">
                                            {{ $cartItem->product->name }}
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <label for="">{{ $cartItem->quantity }}</label>
                                </div>
                                <div class="col-md-3">
                                    <label for="">{{ $cartItem->product->selling_price }}</label>
                                </div>
                                @php
                                    $total_price += $cartItem->product->selling_price * $cartItem->quantity;
                                @endphp
                            @endforeach

                        </div>
                        <hr>
                        <h5 class="row">
                            <span class="col-5">Total:</span>
                            <span class="col-6 d-flex justify-content-end"> ${{ $total_price }}</span>
                        </h5>
                        <hr>
                        <button type="button" wire:click='placeOrder' class="btn btn-info col-md-12 w-100 mb-2">Cash on
                            Delivery</button>
                        <br>
                        <div wire:ignore>
                            <div id="paypal-button-container">
                                <div id="smart-button-container">
                                    <div style="text-align: center;">
                                        <div id="paypal-button-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    @endif

</div>
@push('scripts')
    <script
        src="https://www.paypal.com/sdk/js?client-id=AQyXumneYavlMaRkXzCXS-rUhUAP2SRwrX2Z-i9GAP6xN3nw6L06Bm5n_tOPP0DpOeH087-Uo1porDAh&enable-funding=venmo&currency=USD"
        data-sdk-integration-source="button-factory"></script>
    <script>
        function initPayPalButton() {
            paypal.Buttons({
                style: {
                    shape: 'rect',
                    color: 'gold',
                    layout: 'vertical',
                    label: 'paypal',

                },

                onClick: function() {
                    if (!document.getElementById('fullname').value ||
                        !document.getElementById('phone').value ||
                        !document.getElementById('email').value ||
                        !document.getElementById('pincode').value ||
                        !document.getElementById('address').value
                    ) {
                        Livewire.emit('validationForAll');
                        return false;
                    } else {
                        @this.set('fullname', document.getElementById('fullname').value);
                        @this.set('phone', document.getElementById('phone').value);
                        @this.set('email', document.getElementById('email').value);
                        @this.set('pincode', document.getElementById('pincode').value);
                        @this.set('address', document.getElementById('address').value);

                    }
                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            "amount": {
                                "currency_code": "USD",
                                "value": {{ $total_price }}
                            }
                        }]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        const transaction = orderData.purchase_units[0].payments.captures[0];
                        if (transaction.status == "COMPLETED") {
                            Livewire.emit('transactionEmit', transaction.id);
                        }
                    });
                },

                onError: function(err) {
                    console.log(err);
                }
            }).render('#paypal-button-container');
        }
        initPayPalButton();
    </script>
@endpush
