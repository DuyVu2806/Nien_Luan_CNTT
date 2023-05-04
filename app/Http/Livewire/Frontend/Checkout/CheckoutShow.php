<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0, $cartCount = 0;

    public $fullname, $email, $phone, $pincode, $address, $payment_mode = 'Cash On Delivery', $payment_id = NULL;

    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];

    public function paidOnlineOrder($value)
    {
        $this->payment_id = $value;
        $this->payment_mode = 'Paid by Paypal';
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'stracking_no' => 'order' . Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);

        foreach ($this->carts as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price,
            ]);
            if ($cartItem->product_color_id != NULL) {
                $cartItem->productColor()->where('id', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
            } else {
                $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
            }
        }
        Cart::where('user_id', auth()->user()->id)->where('checkItem', '1')->delete();
        $this->emit('CardAddedUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Cart Item Deleted successflully',
            'type' => 'success',
            'status' => 404
        ]);

        return redirect()->to('thank-you');
    }

    public function validationForAll()
    {
        $this->validate();
    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|min:10',
            'pincode' => 'required|string|max:6|min:6',
            'address' => 'required|string|max:500',
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'stracking_no' => 'order' . Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);

        foreach ($this->carts as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price,
            ]);
            if ($cartItem->product_color_id != NULL) {
                $cartItem->productColor()->where('id', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
            } else {
                $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
            }
        }
        Cart::where('user_id', auth()->user()->id)->where('checkItem', '1')->delete();
        $this->emit('CardAddedUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Cart Item Deleted successflully',
            'type' => 'success',
            'status' => 404
        ]);

        return redirect()->to('thank-you');
    }

    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->cartCount = Cart::where('user_id', auth()->user()->id)->where('checkItem', '1')->count();
        $this->carts = Cart::where('user_id', auth()->user()->id)->where('checkItem', '1')->get();
        return view('livewire.frontend.checkout.checkout-show');
    }
}
