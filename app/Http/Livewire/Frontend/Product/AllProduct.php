<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AllProduct extends Component
{

    public $products, $brands, $categories, $brandInputs = [], $priceInputs, $cateInputs = [];

    protected $queryString = [
        'cateInputs' => ['except' => '', 'as' => 'category'],
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

    public function render()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->products = Product::all();
        $this->products = Product::when($this->cateInputs, function ($q) {
            $q->whereIn('category_id', $this->cateInputs);
        })
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
        return view('livewire.frontend.product.all-product', [
            'products' => $this->products,
            'brands' => $this->brands,
            'categories' => $this->categories,
        ]);
    }
}
