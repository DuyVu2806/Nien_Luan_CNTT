<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ReplyComment;
use App\Models\Review;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        $prod = Product::where('trending', '1')->get();
        $prodNew = Product::orderBy('created_at', 'DESC')->limit(5)->get();
        return view('frontend.index', compact('sliders', 'prod', 'prodNew'));
    }

    public function categories()
    {
        $categories = Category::where('status', '0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }


    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {

            return view('frontend.collections.product.index', compact('category'));
        } else {
            return redirect()->back();
        }
    }

    public function productView($category_slug, $product_flug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            $product = $category->products()->where('slug', $product_flug)->where('status', '0')->first();
            if ($product) {
                // $review = Review::get();
                $reviewcount = Review::whereHas('orderItem', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                })->count();
                $review = Review::whereHas('orderItem', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                })->get();
                $listReplyComment = array();
                foreach ($review as $reviews) {
                    $replyComments = ReplyComment::where('comment_id', '=', $reviews->id)->get();
                    $listReplyComment[$reviews->id] = $replyComments;
                }
                return view('frontend.collections.product.view', compact('category', 'product', 'review', 'reviewcount','listReplyComment'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function contactView()
    {
        return view('frontend.contact.view');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::query();

        if ($query) {
            $products->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhereHas('category', function ($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    });
            });
        }

        $products = $products->get();
        return view('frontend.search', compact('products', 'query'));
    }

    public function allproductview()
    {
        $products = Product::where('status', '0')->get();

        return view('frontend.collections.product.allProduct', compact('products'));
    }

    public function thankyou()
    {
        return view('frontend.thank_you');
    }
}
