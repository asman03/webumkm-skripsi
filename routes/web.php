<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Route::get('/', 'HomeController@index')->name('home');
Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

Route::get('/blog', 'BlogController@index')->name('blog');
Route::get('/blog/details/{id}', 'BlogController@detail')->name('blog-detail');

Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/details/{id}', 'DetailController@add')->name('detail-add');

Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');

Route::get('/success', 'SuccessController@index')->name('success');
Route::get('/register/success', 'Auth\RegisterController@success')->name('register');


Route::group(['middleware' => ['auth','verified']], function(){
        Route::get('/cart', 'CartController@index')->name('cart');
        Route::post('/cart-inc/{id}', 'CartController@increment')->name('inc');
        Route::post('/cart-dec/{id}', 'CartController@decrement')->name('dec');


        Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');
        Route::post('/checkout', 'CheckoutController@process')->name('checkout');
        Route::get('/checkout/finish', 'CheckoutController@finishRedirect')->name('midtrans-finish');
        Route::get('/checkout/unfinish', 'CheckoutController@unfinishRedirect')->name('midtrans-unfinish');
        Route::get('/checkout/error', 'CheckoutController@errorRedirect')->name('midtrans-error');

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-product');
        Route::get('/dashboard/products/create', 'DashboardProductController@create')
                ->name('dashboard-product-create');
        Route::post('/dashboard/products', 'DashboardProductController@store')
                ->name('dashboard-product-store');

        Route::get('/dashboard/products/{id}', 'DashboardProductController@details')
                ->name('dashboard-product-details');
        Route::post('/dashboard/products/{id}', 'DashboardProductController@update')
                ->name('dashboard-product-update');
        Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')
                ->name('dashboard-product-gallery-upload');
        Route::get('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')
                ->name('dashboard-product-gallery-delete');
        Route::delete('/dashboard/products-delete/{id}', 'DashboardProductController@destroy')
                ->name('dashboard-product-delete-all');      
        Route::POST('comentar-user','Admin\ProductController@comment')->name('commentar');


        Route::get('/dashboard/transactions', 'DashboardTransactionsController@index')->name('dashboard-transactions');
        Route::get('/dashboard/transactions/{id}', 'DashboardTransactionsController@details')
                ->name('dashboard-transactions-details');
        Route::post('/dashboard/transactions/{id}', 'DashboardTransactionsController@update')
                ->name('dashboard-transaction-update');

        Route::get('/dashboard/settings', 'DashboardSettingController@store')->name('dashboard-settings-store');
        Route::get('/dashboard/account', 'DashboardSettingController@account')
                ->name('dashboard-account');
        Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')
                ->name('dashboard-settings-redirect');
});


Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin'])  
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');
        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');
        Route::resource('blog', 'BlogController');
        Route::resource('transaction', 'TransactionController');
       });

Auth::routes(['verify' => true]);









