<?php

Auth::routes();
//
//// User profile
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'HomeController@index')->name('profile');
});
//// Main Controller
Route::get('/', [
    'uses' => 'Client\MainController@Index',
    'as'   => 'index'
]);
//// Categories Controller
Route::name('category')->get('category/{category}', 'Client\CategoriesController@index');
//// ProductController
Route::get('products/{id}', [
    'uses' => 'Client\ProductController@show',
    'as'   => 'product.show'
]);

// Cart Controller
Route::get('/add-to-cart/{id}', [
    'uses' => 'Client\CartController@getAddToCart',
    'as'   => 'product.addToCart'
]);
Route::get('reduce/{id}', [
    'uses' => 'Client\CartController@getReduceByOne',
    'as'   => 'product.reduceByOne'
]);
Route::get('/remove/{id}', [
    'uses' => 'Client\CartController@getRemoveItem',
    'as'   => 'product.remove'
]);

//Route::name('cart.add')->get('cart/add/{id}', 'CartController@addItem');
//Route::name('cart.reduce')->get('cart/reduce/{id}', 'CartController@reduceItem');
//Route::name('cart.remove')->get('cart//remove/{id}', 'CartController@removeItem');

/**
 * Search
 */

    Route::name('search')->post('search', 'SearchController@search');

/**
 * Checkout
 */

    Route::name('shopping-cart')->get('shopping-cart', 'Client\CartController@shoppingCart');
    Route::name('checkout')->get('checkout', 'Client\OrderController@checkout');
    Route::name('checkout')->post('checkout', 'Client\OrderController@processCheckout');
