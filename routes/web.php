<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\ManageOrderController;
use App\Http\Controllers\Admin\ManagecustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WishlistController;
// use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use GuzzleHttp\Middleware;


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


Route::group([], function(){
    route::post('enquiry.store',[EnquiryController::class,'store'])->name('enquiry.store');

route::get('admin',[LoginController::class,'index'])->name('login');
route::post('login',[LoginController::class,'login'])->name('login.post');
route::get('/',[HomeController::class,'index'])->name('home');

route::get('contact',[ContactController::class,'index'])->name('contact');
route::get('/category/{urlkey}',[HomeController::class,'categories'])->name('categoryData');
route::get('/product/{urlkey}',[HomeController::class,'product'])->name('productData');
// route::get('cart',[CartController::class,'addToCart'])->name('cart');

Route::post('cart/store/{id}', [CartController::class, 'addToCart'])->name('cart.store');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
// cart delete
Route::delete('cart/delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::post('cart/update/{id}', [CartController::class,'cartUpdate'])->name('cart.update');
route::get('checkout',[CheckoutController::class,'checkoutData'])->name('checkout');
route::post('cart\order',[CheckoutController::class,'store'])->name('checkout.store');
route::post('cart\shipping',[CheckoutController::class,'cartstore'])->name('cart.shipping.apply');
//customer
route::get('customer/ragister',[CustomerController::class,'index'])->name('customer.create');
route::post('customer/store',[CustomerController::class,'store'])->name('customer.store');
route::get('customer/login',[CustomerController::class,'login'])->name('customer.login');
route::post('customer/authenticate',[CustomerController::class,'authenticate'])->name('customer.authenticate');

route::get('customer/logout',[CustomerController::class,'logout'])->name('customer.logout');
route::get('customer/profile',[CustomerController::class,'profile'])->name('customer.profile');
route::post('customer/update',[CustomerController::class,'update'])->name('customer.update');

// coupon apply
Route::post('coupon/apply', [CartController::class, 'couponApply'])->name('coupon.apply');
//checkSuccess
route::get('order/success',[CheckoutController::class,'success'])->name('check.success');

//wiehlist
route::post('wishlist/store',[WishlistController::class,'wishliststore'])->name('wishlist.store');
route::get('wishlist/destroy{id}',[WishlistController::class,'wishlistdestroy'])->name('wishlist.destroy');
route::get('wishlist/profile',[WishlistController::class,'wishlistprofile'])->name('wishlist.list');

route::get('/{urlKey}',[HomeController::class,'page'])->name('page');
});

route::group(['prefix'=>'admin','middleware'=>['auth','front_user']],function(){
    route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    route::get('logout',[LoginController::class,'logout'])->name('logout');
    route::resource('user',UserController::class);
    route::resource('permission',PermissionController::class);
    route::resource('role',RoleController::class);
    route::resource('page',PageController::class);
    route::resource('slider',SliderController::class);
    route::resource('block',BlockController::class);
    route::resource('product',ProductController::class);
    route::resource('category',CategoryController::class);
    route::resource('attribute',AttributeController::class);
    route::resource('coupons',CouponController::class);
    route::get('enquiry',[EnquiryController::class,'index'])->name('enquiry');
    route::get('manage/customer',[ManagecustomerController::class,'index'])->name('manage.customer');
    route::get('customer/show/{id}',[ManagecustomerController::class,'show'])->name('customer.show');
    route::get('customer/view/{id}',[ManagecustomerController::class,'show'])->name('customer.view');
    Route::post('ckeditor/upload', [PageController::class, 'upload'])->name('ckeditor.upload');
    Route::post('ckeditor/upload', [BlockController::class, 'upload'])->name('ckeditor.upload');
    Route::post('ckeditor/upload', [ProductController::class, 'upload'])->name('ckeditor.upload');
    Route::get('manageorder', [ManageOrderController::class, 'index'])->name('manageorder');
    Route::get('order.show/{id}', [ManageOrderController::class, 'show'])->name('order.show');

});

