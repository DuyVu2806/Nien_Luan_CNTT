<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $orderItems = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status_message', '=', 'delivered')
            ->select(DB::raw('YEAR(order_items.created_at) as year'), DB::raw('MONTH(order_items.created_at) as month'), DB::raw('SUM(order_items.quantity * order_items.price) as monthly_revenue'))
            ->groupBy('year', 'month')
            ->get();
        $totalOrder = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status_message', '=', 'delivered')
            ->sum('quantity');
        $totalPrice = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status_message', '=', 'delivered')
            ->sum(DB::raw('quantity * price'));
        $today_sales = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status_message', '=', 'delivered')
            ->whereDate('orders.created_at', Carbon::today())
            ->sum(DB::raw('quantity * price'));
        $total_reviews = Review::count();
        $quantityByCategory = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(order_items.quantity) as quantity'))
            ->groupBy('categories.name')
            ->get();
        
        $categoriesBought = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name')
            ->distinct()
            ->get();
        return view('admin.dashboard', compact("orderItems", "totalOrder", "totalPrice", "today_sales", "total_reviews", "quantityByCategory","categoriesBought"));
    }
}
