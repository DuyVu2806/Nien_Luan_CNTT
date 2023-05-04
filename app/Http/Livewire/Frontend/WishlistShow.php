<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{

    public function removeWishlistItem($wishlistId)
    {
        Wishlist::where('user_id',auth()->user()->id)->where('id',$wishlistId)->delete();
        $this->emit('wishlistAddedUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Wishlist Item Remove Successfully',
            'type' => 'success',
            'status' => 409
        ]);
        return false;
    }

    public function render()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show',[
            'wishlist' => $wishlist
        ]);
    }
}
