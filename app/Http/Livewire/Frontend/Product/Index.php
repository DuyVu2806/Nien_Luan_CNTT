<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $products, $category, $brandInputs = [], $priceInputs;

    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
        'priceInputs' => ['except' => '', 'as' => 'price'],
    ];

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

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $this->products = Product::where('category_id', $this->category->id)
            ->when($this->brandInputs, function ($q) {
                $q->whereIn('brand_id', $this->brandInputs);
            })
            ->when($this->priceInputs, function ($q) {
                $q->when($this->priceInputs == 'high-to-low', function ($e) {
                    $e->orderBy('selling_price', 'DESC');
                })
                    ->when($this->priceInputs == 'low-to-high', function ($e) {
                        $e->orderBy('selling_price', 'ASC');
                    });
            })
            ->where('status', '0')
            ->get();

        return view('livewire.frontend.product.index', [
            'products' => $this->products,
            'category' => $this->category,
        ]);
    }
}
