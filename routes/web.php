<?php

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
    return view('pages.index');
});

// Public
Route::get('/index', 'PageController@index')->name('index');
Route::get('/collections', 'ProductController@index')->name('collections');
Route::get('/collections/search', 'ProductController@search');

// Admin
Route::get('/admin/dashboard', 'AdminController@adminDashboard');
Route::get('/admin/profile', 'AdminController@adminProfile');
Route::get('/admin/products', 'AdminController@adminProducts');
Route::get('/admin/users', 'AdminController@adminUsers');
Route::get('/admin/inventory', 'AdminController@adminInventory');
Route::get('/admin/transactions', 'AdminController@adminTransactions');
Route::get('/admin/products/add', 'AdminProductController@create');
Route::post('/admin/products/add', 'AdminProductController@store');
Route::get('/admin/products/restore', 'AdminController@restorePage');
Route::get('/admin/categories/index', 'CategoryController@index');
Route::get('/admin/categories/add', 'CategoryController@create');
Route::post('/admin/categories/add', 'CategoryController@store');
Route::get('/collections/search/admin', 'AdminController@search');


// Users
Route::get('/user/dashboard', 'UserController@userDashboard');
Route::get('/user/profile', 'UserController@userProfile');
Route::get('/user/transactions', 'UserController@userTransactions');
Route::get('/user/favorites', 'FavoritesController@showFavorites');
Route::get('/user/favorite/{id}/delete', 'FavoritesController@deleteFavorite');

// Cart
Route::get('/user/cart', 'CartController@show');
Route::get('/user/cart/emptyCart', 'CartController@emptyCart');
Route::get('/user/cart/checkout', 'CartController@checkout');


// Public - with wildcards
Route::get('/collections/filter/category/{id}', 'ProductController@filterByCategory');
Route::get('/collections/{id}', 'ProductController@show');
Route::post('/collections/{id}', 'ProductController@show');

// Admin -with wildcards
Route::get('/admin/products/{id}', 'AdminProductController@show');
Route::get('/admin/products/{id}/edit', 'AdminProductController@edit');
Route::patch('/admin/products/{id}/edit', 'AdminProductController@update');
Route::patch('/admin/products/{id}/edit/stock', 'AdminProductController@updateStock');
Route::get('/admin/products/{id}/add/size', 'AdminProductController@addSize');
Route::delete('/admin/products/{id}/delete', 'AdminProductController@destroy');
Route::get('/admin/products/restore/{id}', 'AdminController@restore');
Route::get('/admin/categories/{id}/edit', 'CategoryController@edit');
Route::patch('/admin/categories/{id}/edit', 'CategoryController@update');
Route::delete('/admin/categories/{id}/delete', 'CategoryController@destroy');
Route::get('/admin/transactions/{id}', 'AdminController@showTransaction');
Route::get('/admin/order/{id}/approve', 'AdminController@approveOrder');
Route::get('/admin/order/{id}/cancel', 'AdminController@cancelOrder');
Route::get('/collections/filter/status/{id}', 'AdminController@filterByStatus');
Route::get('/admin/products/delete/{id}', 'AdminController@deleteTrashItem');
Route::get('/admin/user/{id}/delete', 'AdminController@deleteUser');
Route::get('/admin/order/{id}/show', 'AdminController@adminShowOrder');


// Users - with wildcards
Route::post('/user/cart/{id}/add', 'CartController@addToCart');
Route::get('/user/order/{id}/cancel', 'UserController@cancelOrder');
Route::get('/user/favorites/{id}', 'FavoritesController@addFavorites');
Route::get('/user/order/{id}/show', 'UserController@userShowOrder');
Route::patch('/user/profile/{id}/edit', 'UserController@editName');

// Cart - with wildcards
Route::post('/user/cart/{id}/edit', 'CartController@editCart');
Route::get('/user/cart/{id}/delete', 'CartController@deleteCartItem');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
