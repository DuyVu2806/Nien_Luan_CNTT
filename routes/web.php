<?php

use App\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Customer Route
Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
Route::get('/collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'products']);
Route::get('/collections/{category_slug}/{product_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'productView']);
Route::get('/contact',[App\Http\Controllers\Frontend\FrontendController::class, 'contactView']);
Route::get('search',[App\Http\Controllers\Frontend\FrontendController::class, 'search']);

Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index']);
    Route::get('cart',[App\Http\Controllers\Frontend\CartController::class,'index']);
    Route::get('/checkout',[App\Http\Controllers\Frontend\CheckoutController::class,'index']);
    Route::get('/order',[App\Http\Controllers\Frontend\OrderController::class,'index']);
    Route::get('/order/{order_id}',[App\Http\Controllers\Frontend\OrderController::class,'view']);
    Route::get('/profile',[App\Http\Controllers\Frontend\UserController::class,'show']);
    Route::post('/profile',[App\Http\Controllers\Frontend\UserController::class,'updateUserDetail']);
    Route::get('/change-password',[App\Http\Controllers\Frontend\UserController::class,'passwordCreate']);
    Route::post('/change-password',[App\Http\Controllers\Frontend\UserController::class,'changePassword']);
    Route::post('/review/{order_item_id}',[App\Http\Controllers\Frontend\ReviewController::class,'reviewPost']);
});

Route::get('thank-you',[App\Http\Controllers\Frontend\FrontendController::class,'thankyou']);
Route::get('/all-product', [App\Http\Controllers\Frontend\FrontendController::class, 'allproductview']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Admin Route
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Slider Route
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders', 'store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('sliders/{slider}', 'destroy');
    });

    // Category Route
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');
        Route::get('/category/{category}', 'destroy');
    });

    // Brand Routs
    Route::controller(App\Http\Controllers\Admin\BrandController::class)->group(function () {
        Route::get('/brand', 'index');
        Route::get('/users','viewUsers');
        Route::post('/users/{user_id}','postUser');
    });

    //Product Route

    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::put('/products/{product}', 'update');
        Route::get('/products/{product}', 'destroy');

        Route::get('product-image/{product_image_id}/delete', 'destroyImage');
        Route::post('product-color/{prod_color_id}', 'updateProdColorQty');
        Route::get('product-color/{prod_color_id}/delete', 'deleteProdColor');

        Route::get('/review','getReview');
    });
    //Color Route
    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::get('/colors', 'index');
        Route::get('/colors/create', 'create');
        Route::post('/colors', 'store');
        Route::get('/colors/{color}/edit', 'edit');
        Route::put('/colors/{color}', 'update');
        Route::get('/colors/{color}', 'destroy');
    });

    //Orders Route
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{order_id}','view');
        Route::post('/orders/{order_id}','updateStatusMessage');
        Route::post('/orders/reply/{order_id}','replyComment');

        Route::get('invoice/{order_id}','viewInvoice');
        Route::get('invoice/{order_id}/generate','generateInvoice');
    });
    
});
