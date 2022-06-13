<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\BrandsController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\ChildCategoryController;
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
// Remove mini cart
Route::get('/product/mini/cart/remove/{rowId}', [CartController::class, 'removeCart']);
//wishlist
Route::post('/add-to-wishlist/{id}', [WishlistController::class, 'AddToWishlist']); 




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

        Route::post('/image/update', [ProductController::class, 'UpdateImage'])->name('product.updateThambnail');
    });

});

Route::get('/language/english}', [LanguageController::class, 'english'])->name('language.english');

Route::get('/language/bangla}', [LanguageController::class, 'bangla'])->name('language.bangla');


Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);

Route::get('/sub-subcategory/ajax/{sub_category_id}', [SubCategoryController::class, 'GetChildCategory']);
