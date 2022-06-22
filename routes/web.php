<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CashController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\BrandsController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Frontend\StripeController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\ShippingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ShippingStateController;
use App\Http\Controllers\Backend\ShippingDistrictController;
use App\Http\Controllers\Backend\ShippingDivisionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/product/view/modal/{id}', [FrontendController::class, 'ProductViewAjax']);
Route::get('/product/{product:id}', [FrontendController::class, 'productDetails'])->name('product-details');
// Add to Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
// Get Data from cart
Route::get('/product/mini/cart/', [CartController::class, 'getCart']);
// Get Data from cart
Route::get('/user/cart', [CartController::class, 'index'])->name('my-cart');
Route::get('/cart', [CartController::class, 'myCart']);
Route::get('/cart-increment/{rowId}', [CartController::class, 'CartIncrement']);
Route::get('/cart-decrement/{rowId}', [CartController::class, 'CartDecrement']);
// Remove mini cart
Route::get('/product/mini/cart/remove/{rowId}', [CartController::class, 'removeCart']);
//wishlist
Route::post('/add-to-wishlist/{id}', [WishlistController::class, 'AddToWishlist']);
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calc', [CartController::class, 'CouponCalc']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

Route::get('/district-get/ajax/{division_id}', [ShippingController::class, 'DistrictGetAjax']);

Route::get('/state-get/ajax/{district_id}', [ShippingController::class, 'StateGetAjax']);




//For users
Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
          Route::view('/login','dashboard.user.login')->name('login');
          Route::view('/register','dashboard.user.register')->name('register');
          Route::view('/forget-password','dashboard.user.forget-password')->name('forget_password');
          Route::post('/create',[UserController::class,'create'])->name('create');
          Route::post('/check',[UserController::class,'check'])->name('check');
    });

    Route::middleware(['auth','PreventBackHistory'])->group(function(){
          Route::get('/profile', [UserProfileController::class, 'home'])->name('home');
          Route::get('/profile/edit',[UserProfileController::class, 'profile_edit'])->name('edit');
          Route::post('/profile/change',[UserProfileController::class, 'profileUpdate'])->name('profile_update');
          Route::get('/profile/password',[UserProfileController::class, 'password_edit'])->name('change-password');
          Route::post('/profile/password',[UserProfileController::class, 'password_update'])->name('update-password');
          Route::post('/logout',[UserController::class,'logout'])->name('logout');
          Route::get('/add-new',[UserController::class,'add'])->name('add');
          Route::get('/my-order',[UserProfileController::class,'MyOrders'])->name('my-order');
          Route::get('/my-order/{id}',[UserProfileController::class,'SingleOrder'])->name('order-details');
          Route::get('/invoice/{id}',[UserProfileController::class,'Invoice'])->name('invoice');
          Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');
          Route::post('/checkout/store', [ShippingController::class, 'CheckoutStore'])->name('checkout.store');
          Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');
          Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');
          //wishlist crud
        Route::resource('wishlist', WishlistController::class);

    });

});


//For Admin
Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
          Route::view('/login','dashboard.admin.login')->name('login');
          Route::post('/check',[AdminController::class,'check'])->name('check');
    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('/dashboard','dashboard.admin.home')->name('home');
        Route::get('/profile',[AdminProfileController::class, 'profile'])->name('profile');
        Route::get('/profile/edit',[AdminProfileController::class, 'profile_edit'])->name('edit');
        Route::post('/profile/update',[AdminProfileController::class, 'profile_update'])->name('update');
        Route::get('/profile/password',[AdminProfileController::class, 'password_edit'])->name('change-password');
        Route::post('/profile/password',[AdminProfileController::class, 'password_update'])->name('update-password');

        Route::post('/logout',[AdminController::class,'logout'])->name('logout');


        //brands crud
        Route::resource('brands',BrandsController::class);

        //category crud
        Route::resource('category', CategoryController::class);

        //sub category crud
        Route::resource('sub_category', SubCategoryController::class);

        //child category crud
        Route::resource('child_category', ChildCategoryController::class);

        //product crud
        Route::resource('product', ProductController::class);

        //product crud
        Route::resource('slider', SliderController::class);

        //coupon crud
        Route::resource('coupon', CouponController::class);

        //shipping division crud
        Route::resource('division', ShippingDivisionController::class);

        //shipping district crud
        Route::resource('district', ShippingDistrictController::class);

        //product state crud
        Route::resource('state', ShippingStateController::class);

        Route::get('/pending-order',[OrderController::class,'PendingOrders'])->name('order.pending');
        Route::get('/processing-order',[OrderController::class,'ProcessingOrders'])->name('order.processing');
        Route::get('/confirmed-order',[OrderController::class,'ConfirmedOrders'])->name('order.confirmed');
        Route::get('/delivered-order',[OrderController::class,'DeliveredOrders'])->name('order.delivered');
        Route::get('/picked-order',[OrderController::class,'PickedOrders'])->name('order.picked');
        Route::get('/shipped-order',[OrderController::class,'ShippedOrders'])->name('order.shipped');
        Route::get('/cancel-order',[OrderController::class,'CancelOrders'])->name('order.cancel');
        Route::get('/pending-order/{order_id}',[OrderController::class,'PendingOrdersDetails'])->name('order.pending-details');


        Route::post('/image/update', [ProductController::class, 'UpdateImage'])->name('product.updateThambnail');
    });

});

Route::get('/language/english}', [LanguageController::class, 'english'])->name('language.english');

Route::get('/language/bangla}', [LanguageController::class, 'bangla'])->name('language.bangla');


Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);

Route::get('/sub-subcategory/ajax/{sub_category_id}', [SubCategoryController::class, 'GetChildCategory']);

Route::get('/district/ajax/{division_id}', [ShippingDivisionController::class, 'GetDistrict']);
Route::get('/state/ajax/{district_id}', [ShippingDivisionController::class, 'GetState']);
