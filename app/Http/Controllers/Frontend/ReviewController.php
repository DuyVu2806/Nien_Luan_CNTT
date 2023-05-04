<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function reviewPost(Request $request, $id)
    {

        $validated = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string',
            'outstanding_feature' => 'nullable|string',
            'transportation' => 'nullable|string',
        ]);

        $review = new Review();
        $review->user_id = Auth::id();
        $review->outstanding_feature = $validated['outstanding_feature'];
        $review->transportation = $validated['transportation'];
        $review->rating = $validated['rating'];
        $review->comment = $validated['comment'];
        $review->order_item_id = $id;
        $review->save();
        $orderItem = OrderItem::where('id', $id)->first();
        $orderItem->update(['rstatus' => true]);
        $product = Product::where('id',$orderItem->product->id)->first();
        $reviewCount = Review::whereHas('orderItem', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->count();
        $reviews = Review::whereHas('orderItem', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();
        $rating = 0;
        foreach ($reviews as $item) {
            $rating += $item->rating;
        }
        $rating = $rating / $reviewCount;
        $product->update(['rating' => $rating]);
        return response()->json(['success' => true]);
    }
}
