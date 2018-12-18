<?php

Auth::routes();

Route::name('/')->get('/', 'Client\MainController@index');

/**
 * Categories
 */

    Route::name('categories')->get('category/{id}', 'Client\CategoriesController@index');

/**
 * Products
 */

    Route::name('products')->get('product/{id}', 'Client\CategoriesController@index');

/**
 * Search
 */

    Route::name('search')->post('search', 'SearchController@search');

/**
 * Cart
 */

    Route::name('shopping-cart')->get('shopping-cart', 'Client\CartController@shoppingCart');

    Route::name('cart.add')->get('cart/add/{id}', 'Client\CartController@addItem');
    Route::name('cart.reduce')->get('cart/reduce/{id}', 'Client\CartController@reduceItem');
    Route::name('cart.remove')->get('cart//remove/{id}', 'Client\CartController@removeItem');

/**
 * Checkout
 */    

    Route::name('checkout')->get('checkout', 'Client\OrderController@checkout');
    Route::name('checkout')->post('checkout', 'Client\OrderController@processCheckout');


/**
 * PROFILE
 */
Route::group(['middleware' => 'auth'], function () {

    Route::name('profile')->get('profile/{id}', 'ProfileController@index');
    
});