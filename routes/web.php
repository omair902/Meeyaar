<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\InventoryManagementController;
use App\Http\Controllers\Admin\Order\DispatchedOrderController;
use App\Http\Controllers\Admin\ShippingManagement\DispatchedOrderController as ShippingDIspatchedOrderController;
use App\Http\Controllers\Admin\Order\ComplainOrderController;
use App\Http\Controllers\Admin\ShippingManagement\ComplainOrderController as ShippingComplainOrderController;
use App\Http\Controllers\Admin\Order\CompletedOrderController;
use App\Http\Controllers\Admin\ShippingManagement\CompletedOrderController as ShippingCompletedOrderController;
use App\Http\Controllers\Admin\Order\PendingOrderController;
use App\Http\Controllers\Admin\Order\CancelledOrderController;
use App\Http\Controllers\Admin\ShippingManagement\NewOrderController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use App\Models\Product;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);



Route::group(['prefix'=>'/admin','middleware'=>['auth','role:admin']],function()
{
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/profile_setting',[DashboardController::class,'profile_setting'])->name('admin.profile_setting');
    Route::post('/update_profile',[DashboardController::class,'update_profile'])->name('admin.update_profile');
    Route::get('/password_setting',[DashboardController::class,'password_setting'])->name('admin.password_setting');
    Route::post('/update_password',[DashboardController::class,'update_password'])->name('admin.update_password');

    Route::get('/products',[ProductController::class,'index'])->name('admin.products');
    Route::get('/create_product',[ProductController::class,'create'])->name('admin.product.create');
    Route::post('/product/store',[ProductController::class,'store'])->name('admin.product.store');
    Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('admin.product.edit');
    Route::patch('/product/update/{id}',[ProductController::class,'update'])->name('admin.product.update');
    Route::get('/product/edit/remove_image/{id}',[ProductController::class,'remove_image'])->name('admin.product.remove_image');
    Route::delete('/products/delete/{id}',[ProductController::class,'destroy'])->name('admin.product.destroy');
    Route::patch('/products/change_trending_option/{id}',[ProductController::class,'change_trending_option']);
    Route::patch('/products/change_seller_option/{id}',[ProductController::class,'change_seller_option']);
    Route::get('/products/get_subcategories/{id}',[ProductController::class,'get_subcategories']);

    Route::get('/manage_categories',[CategoryController::class,'index'])->name('admin.manage_categories');
    Route::post('/manage_categories/category/store',[CategoryController::class,'store_category'])->name('admin.store_category');
    Route::get('/manage_categories/category/edit/{id}',[CategoryController::class,'edit_category'])->name('admin.edit_category');
    Route::patch('/manage_categories/category/update/{id}',[CategoryController::class,'update_category'])->name('admin.update_category');
    Route::delete('/manage_categories/category/delete/{id}',[CategoryController::class,'delete_category'])->name('admin.delete_category');
    Route::post('/manage_categories/sub_category/store',[CategoryController::class,'store_sub_category'])->name('admin.store_sub_category');
    Route::get('/manage_categories/sub_category/edit/{id}',[CategoryController::class,'edit_sub_category'])->name('admin.edit_sub_category');
    Route::patch('/manage_categories/sub_category/update/{id}',[CategoryController::class,'update_sub_category'])->name('admin.update_sub_category');
    Route::delete('/manage_categories/sub_category/delete/{id}',[CategoryController::class,'delete_sub_category'])->name('admin.delete_sub_category');

    Route::get('manage_orders/new',[OrderController::class,'index'])->name('admin.manage_orders.new');
    Route::get('manage_orders/new/view_product/{product}',[OrderController::class,'view_product'])->name('admin.manage_orders.new.view_product');
    Route::get('manage_orders/new/confirmed/{id}',[OrderController::class,'confirmed'])->name('admin.manage_orders.new.confirmed');
    Route::delete('manage_orders/new/cancelled/{id}',[OrderController::class,'cancelled'])->name('admin.manage_orders.new.cancelled');

    Route::get('manage_orders/pending',[PendingOrderController::class,'index'])->name('admin.manage_orders.pending');

    Route::get('manage_orders/cancelled',[CancelledOrderController::class,'index'])->name('admin.manage_orders.cancelled');

    Route::get('manage_orders/dispatched',[DispatchedOrderController::class,'index'])->name('admin.manage_orders.dispatched');

    Route::get('manage_orders/completed',[CompletedOrderController::class,'index'])->name('admin.manage_orders.completed');

    Route::get('manage_orders/complains/current',[ComplainOrderController::class,'index'])->name('admin.manage_orders.complains.current');
    Route::get('manage_orders/complains/refunded',[ComplainOrderController::class,'refunded'])->name('admin.manage_orders.complains.refunded');
    Route::get('manage_orders/complains/resolved',[ComplainOrderController::class,'resolved'])->name('admin.manage_orders.complains.resolved');

    
    Route::get('shipping_management/new',[NewOrderController::class,'index'])->name('admin.shipping_management.new');
    Route::get('shipping_management/new/dispatched/{id}',[NewOrderController::class,'dispatched'])->name('admin.shipping_management.new.dispatched');
    Route::post('shipping_management/new/complain/{id}',[NewOrderController::class,'complain'])->name('admin.shipping_management.new.complain');

    Route::get('shipping_management/dispatched/completed/{id}',[NewOrderController::class,'completed'])->name('admin.shipping_management.dispatched.completed');

    Route::get('shipping_management/dispatched',[ShippingDispatchedOrderController::class,'index'])->name('admin.shipping_management.dispatched');

    Route::get('shipping_management/completed',[ShippingCompletedOrderController::class,'index'])->name('admin.shipping_management.completed');

    Route::get('shipping_management/complains/current',[ShippingComplainOrderController::class,'index'])->name('admin.shipping_management.complains.current');
    Route::get('shipping_management/complains/current/refunded/{id}',[ShippingComplainOrderController::class,'refunded'])->name('admin.shipping_management.complains.current.refunded');
    Route::get('shipping_management/complains/current/resolved/{id}',[ShippingComplainOrderController::class,'resolved'])->name('admin.shipping_management.complains.current.resolved');

    Route::get('shipping_management/complains/refunded',[ShippingComplainOrderController::class,'refunded_complains'])->name('admin.shipping_management.complains.refunded');
    Route::get('shipping_management/complains/resolved',[ShippingComplainOrderController::class,'resolved_complains'])->name('admin.shipping_management.complains.resolved');
    
    Route::get('inventory_management',[InventoryManagementController::class,'index'])->name('admin.inventory_management');
    Route::post('inventory_management/add_stock/{id}',[InventoryManagementController::class,'add_stock'])->name('admin.inventory_management.add_stock');
    Route::post('inventory_management/reduce_stock/{id}',[InventoryManagementController::class,'reduce_stock'])->name('admin.inventory_management.reduce_stock');
    Route::post('inventory_management/out_of_stock/{id}',[InventoryManagementController::class,'out_of_stock'])->name('admin.inventory_management.out_of_stock');


});

Route::group(['prefix'=>'/customer','middleware'=>['auth','role:customer','verified']],function()
{
    Route::get('/products',[CustomerProductController::class,'index'])->name('customer.products');
    Route::get('/products/order/{product_id}',[CustomerProductController::class,'order'])->name('customer.products.order');

});
Route::redirect('/home','/customer/products');
// Route::get('');
