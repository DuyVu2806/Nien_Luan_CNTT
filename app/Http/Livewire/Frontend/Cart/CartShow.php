<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Illuminate\Console\View\Components\Alert;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $carts,$cartCount = 0;

    public function mount()
    {
        $this->carts = Cart::all()->keyBy('id')->toArray();
    }

    public function updateSelections($itemId)
    {
        Cart::where('id', $itemId)->update(['checkItem' => $this->carts[$itemId]['checkItem']]);
    }


    public function plusQty($cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only ' . $productColor->quantity . ' Item To Product',
                        'type' => 'warning',
                        'status' => 200
                    ]);
                }
            } else {
                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only ' . $cartData->product->quantity . ' Item To Product',
                        'type' => 'warning',
                        'status' => 200
                    ]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'danger',
                'status' => 200
            ]);
        }
    }

    public function minusQty($cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->quantity > 1) {
                $cartData->decrement('quantity');
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'At least 1 product',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        }
    }

    public function removeCartItem($cartId)
    {
        $removeCart = Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->first();

        if ($removeCart) {
            $removeCart->delete();
            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cart Item Deleted successflully',
                'type' => 'success',
                'status' => 404
            ]);
        }
    }
    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        $this->cartCount  =Cart::where('user_id',auth()->user()->id)->where('checkItem','1')->count();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart,
            'cartCount' => $this->cartCount,
        ]);
    }
}
