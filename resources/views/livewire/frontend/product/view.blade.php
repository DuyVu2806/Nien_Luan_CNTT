<div class="py-3 py-md-2 bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5 mt-3">
                <div class="bg-white border rounded">
                    <div class="slider">
                        @foreach ($product->productImages as $item)
                            <div class="d-flex justify-content-center align-items-center">
                                <img class="mx-auto my-auto" height="350" src="{{ asset($item->image) }}">
                            </div>
                        @endforeach

                    </div>
                    <hr>

                    <div class="slider-nav mb-2">
                        @foreach ($product->productImages as $key => $item)
                            <div>
                                <img height="50px" width="50px" src="{{ asset($item->image) }}"
                                    onclick="currentSlide({{ $key + 1 }})">
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
            <div class="col-md-7 mt-3">
                <div class="product-view">
                    <h4 class="product-name">
                        {{ $product->name }}
                        @if (!$product->status)
                            <label class="label-stock bg-success">In Stock</label>
                        @else
                            <label class="label-stock bg-danger">Invisible</label>
                        @endif

                    </h4>
                    <hr>
                    <p class="product-path">
                        Home / {{ $product->category->name }} /{{ $product->name }}
                    </p>
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
                    <div>
                        <span class="selling-price">${{ $product->selling_price }}</span>
                        <span class="original-price">${{ $product->original_price }}</span>
                    </div>
                    <div>
                        @if ($product->productColors->count() > 0)
                            @if ($product->productColors)
                                @foreach ($product->productColors as $prodColor)
                                    <label
                                        class="btn-sm {{ $this->isSelected($prodColor->id) ? 'active text-white' : 'text-secondary' }}"
                                        wire:click='colorSelected({{ $prodColor->id }})'
                                        style="background-color: {{ $this->isSelected($prodColor->id) ? $prodColor->color->code : '' }}; border: 1px solid {{ $this->isSelected($prodColor->id) ? $prodColor->color->code : '' }};">
                                        {{ $prodColor->color->name }}
                                    </label>
                                @endforeach
                            @endif

                            <div>
                                @if ($this->prodColorSelectedQty == 'OutOfStock')
                                    <label class="btn-sm bg-danger text-light">Out of Stock</label>
                                @elseif($this->prodColorSelectedQty > 0)
                                    <label class="btn-sm bg-success text-light">In Stock</label>
                                @endif
                            </div>
                        @else
                            @if ($product->quantity)
                                <label class="btn bg-success">In Stock</label>
                            @else
                                <label class="btn bg-danger">Out of Stock</label>
                            @endif
                        @endif

                    </div>
                    <div class="mt-2">
                        <div class="input-group">
                            <span class="btn btn1" wire:click='minusQty'><i class="fa fa-minus"></i></span>
                            <input type="text" wire:model='valueQty' value="{{ $this->valueQty }}"
                                class="input-quantity" />
                            <span class="btn btn1" wire:click='plusQty'><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button wire:click="addToCart({{ $product->id }})" type="button" class="btn btn1"> <i
                                class="fa fa-shopping-cart"></i> Add To
                            Cart
                        </button>
                        <button wire:click="addToWishList({{ $product->id }})" class="btn btn2">
                            <span wire:loading.remove wire:target='addToWishList'>
                                <i class="fa fa-heart"></i>
                            </span>
                            <span wire:loading wire:target='addToWishList'>
                                Adding...
                            </span>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h5 class="mb-0">Small Description</h5>
                        <p>
                            {{ $product->small_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                            data-bs-target="#description-tab-pane" type="button" role="tab"
                            aria-controls="description-tab-pane" aria-selected="true">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review-tab-pane"
                            type="button" role="tab" aria-controls="review-tab-pane"
                            aria-selected="false">Reviews</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade border p-3 show active" id="description-tab-pane" role="tabpanel"
                        aria-labelledby="description-tab" tabindex="0">
                        <p>
                            {!! $product->description !!}
                        </p>
                    </div>
                    <div class="tab-pane fade border p-3" id="review-tab-pane" role="tabpanel"
                        aria-labelledby="review-tab" tabindex="0">
                        <div class="headings d-flex justify-content-between align-items-center mb-3">
                            <h5>Unread comments ({{ $reviewcount }})</h5>
                        </div>
                        @forelse ($review as $reviewItem)
                            <div class="card p-3 mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="user d-flex flex-row align-items-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
                                            width="30" class="user-img rounded-circle mr-2">
                                        <span>
                                            <small class="font-weight-bold text-primary">{{ $reviewItem->user->name }}
                                            </small><br>
                                            <small class="font-weight-bold">
                                                @php
                                                    $rating = $reviewItem->rating;
                                                    $full_stars = floor($rating);
                                                    $half_stars = round($rating - $full_stars, 1) * 10;
                                                @endphp
                                                <span class="stars" style="color: #F39C12">
                                                    @for ($i = 0; $i < $full_stars; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                    @if ($half_stars > 0)
                                                        <i class="fa fa-star-half-o"></i>
                                                    @endif
                                                    @for ($i = $full_stars + 1; $i < 5; $i++)
                                                        <i class="fa fa-star-o"></i>
                                                    @endfor
                                                </span>
                                            </small>
                                        </span>
                                    </div>
                                    <small>{{ now()->diffForHumans($reviewItem->created_at) }}</small>
                                </div>
                                <div class="action d-flex justify-content-between mt-2 align-items-center">
                                    <div class="reply px-4">
                                        <label style="font-size: 10pt">Outstanding Feature:
                                            <span class="text-dark">{{ $reviewItem->outstanding_feature }}</span>
                                        </label><br>
                                        <label style="font-size: 10pt">Transportation:
                                            <span class="text-dark">{{ $reviewItem->transportation }}</span>
                                        </label><br>
                                        <label>Comment:
                                            <span class="text-dark">{{ $reviewItem->comment }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @foreach ($listReplyComment[$reviewItem->id] as $repItem)
                                @if ($repItem['comment_id'] == $reviewItem->id)
                                    <div class="card p-3 mb-2" style="margin-left: 5em">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="user d-flex flex-row align-items-center">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/2048px-User-avatar.svg.png"
                                                    width="30" class="user-img rounded-circle mr-2">
                                                <span>
                                                    <small class="font-weight-bold text-primary">{{$repItem['name']}}
                                                    </small><br>
                                                </span>
                                            </div>
                                            <small>{{ now()->diffForHumans($repItem['created_at']) }}</small>
                                        </div>
                                        <div class="action d-flex justify-content-between mt-2 align-items-center">
                                            <div class="reply px-4">
                                                <label>Comment:
                                                    <span class="text-dark">{{$repItem['comment']}}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        @empty
                            <h5>No Comment</h5>
                        @endforelse


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
