<?php
Auth::routes();
//
//// User profile
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'HomeController@index')->name('profile');
});
////user index
Route::get('/', [
    'uses' => 'Client\ProductController@getIndex',
    'as' => 'product.index'
]);
Route::name('category')->get('category/{category}', 'Client\ProductController@index');

Route::get('products/{id}', [
    'uses' => 'Client\ProductController@show',
    'as' => 'product.show'
]);
//// End User profile
// Shopping Cart
Route::get('/add-to-cart/{id}', [
    'uses' => 'Client\CartController@getAddToCart',
    'as' => 'product.addToCart'
]);
Route::get('reduce/{id}', [
    'uses' => 'Client\CartController@getReduceByOne',
    'as' => 'product.reduceByOne'
]);
Route::get('/remove/{id}', [
    'uses' => 'Client\CartController@getRemoveItem',
    'as' => 'product.remove'
]);
Route::get('/shopping-cart', [
    'uses' => 'Client\CartController@getCart',
    'as' => 'product.shoppingCart'
]);
Route::get('/checkout', [
    'uses' => 'Client\CartController@getCheckout',
    'as' => 'checkout',
    'middleware' => 'auth'
]);
Route::post('/checkout', [
    'uses' => 'Client\CartController@postCheckout',
    'as' => 'checkout',
    'middleware' => 'auth'
]);

////// Admin crud
///// TODO: Setup group middleware, Auth
//Route::group(['prefix' => 'admin', 'as' => 'admin', 'middleware' => 'auth'], function (){
//    Route::resource('products', 'Product\AdminController');
//    Route::resources('categories', 'Categories\AdminController');
//});
