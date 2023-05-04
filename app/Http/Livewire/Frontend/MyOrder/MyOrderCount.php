<?php

namespace App\Http\Livewire\Frontend\MyOrder;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyOrderCount extends Component
{
    public $orderCount;

    public function checkOrderCount()
    {
        if (Auth::check()) {
            return $this->orderCount = Order::where('user_id', auth()->user()->id)->count();
        } else {
            return $this->orderCount = 0;
        }
    }
    public function render()
    {
        $this->orderCount = $this->checkOrderCount();
        return view('livewire.frontend.my-order.my-order-count', [
            'orderCount' => $this->orderCount,
        ]);
    }
}
