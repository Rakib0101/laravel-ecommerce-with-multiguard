<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\AdminProfileController;
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
          Route::view('/profile','dashboard.user.home')->name('home');
          Route::get('/profile/edit',[UserProfileController::class, 'profile_edit'])->name('edit');
          Route::post('/profile/update',[UserProfileController::class, 'profileUpdate'])->name('profile_update');
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
    });

});

