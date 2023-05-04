<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $product, $category, $prodColorSelectedQty, $productId, $valueQty = 1, $ProdColorId, $review, $reviewcount, $listReplyComment;

    public function colorSelected($ProdColorId)
    {
        if ($this->ProdColorId == $ProdColorId) {
            $this->ProdColorId = null;
            $this->prodColorSelectedQty = null;
        } else {
            $this->ProdColorId = $ProdColorId;
            $prodColor = $this->product->productColors()->where('id', $ProdColorId)->first();
            $this->prodColorSelectedQty = $prodColor->quantity;
            if ($this->prodColorSelectedQty == 0) {
                $this->prodColorSelectedQty = 'OutOfStock';
            }
        }
    }

    public function isSelected($colorId = null)
    {
        return $colorId ? $this->ProdColorId == $colorId : $this->ProdColorId !== null;
    }

    public function addToCart($productId)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $productId)->where('status', 0)->get()) {
                if ($this->product->productColors()->count() > 1) {
                    if ($this->prodColorSelectedQty != NULL) {
                        if (Cart::where('user_id', auth()->user()->id)
                            ->where('product_id', $productId)
                            ->where('product_color_id', $this->ProdColorId)
                            ->exists()
                        ) {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Already Added',
                                'type' => 'info',
                                'status' => 404
                            ]);
                        } else {
                            $productColor = $this->product->productColors()->where('id', $this->ProdColorId)->first();
                            if ($productColor->quantity > 0) {
                                if ($productColor->quantity >= $this->valueQty) {

                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->ProdColorId,
                                        'quantity' => $this->valueQty,
                                    ]);
                                    $this->emit('CartAddedUpdated');
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Product Added To Cart',
                                        'type' => 'success',
                                        'status' => 404
                                    ]);
                                } else {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Only ' . $productColor->quantity . ' quantity avaliable',
                                        'type' => 'warning',
                                        'status' => 404
                                    ]);
                                }
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Out of stock',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Select Your Product Color',
                            'type' => 'info',
                            'status' => 404
                        ]);
                    }
                } else {
                    if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product Already Cart',
                            'type' => 'info',
                            'status' => 404
                        ]);
                    } else {
                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity > $this->valueQty) {
                                $this->emit('CartAddedUpdated');
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'product_color_id' => $this->ProdColorId,
                                    'quantity' => $this->valueQty,
                                ]);
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Added To Cart',
                                    'type' => 'success',
                                    'status' => 404
                                ]);
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only ' . $this->product->quantity . ' quantity avaliable',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Out of stock',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product Does not exists',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login To Add To Cart',
                'type' => 'warning',
                'status' => 409
            ]);
        }
    }

    public function plusQty()
    {
        $this->valueQty++;
    }

    public function minusQty()
    {
        if ($this->valueQty > 1) {
            $this->valueQty--;
        }
    }

    public function addToWishList($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                session()->flash('message', 'Already to WishList');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already to WishList',
                    'type' => 'warning',
                    'status' => 409
                ]);
                return false;
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId,
                ]);
                session()->flash('message', 'WishList Added Successfully');
                $this->emit('wishlistAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'WishList Added Successfully',
                    'type' => 'success',
                    'status' => 409
                ]);
            }
        } else {
            session()->flash('message', 'Please Login to countinue');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to countinue',
                'type' => 'warning',
                'status' => 401
            ]);
            return false;
        }
    }
    public function mount($product, $category, $review, $reviewcount, $listReplyComment)
    {
        $this->category = $category;
        $this->product = $product;
        $this->review = $review;
        $this->reviewcount = $reviewcount;
        $this->listReplyComment = $listReplyComment;
    }
    public function render()
    {
        return view('livewire.frontend.product.view', [
            'product' => $this->product,
            'category' => $this->category,
            'review' => $this->review,
            'reviewcount' => $this->reviewcount,
            'listReplyComment' => $this->listReplyComment,
        ]);
    }
}
