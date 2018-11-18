<?php
Auth::routes();
//
//// User profile
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'HomeController@index')->name('profile');
});
////user index
Route::get('/', [
    'uses' => 'Product\ProductClientController@getIndex',
    'as' => 'product.index'
]);
Route::name('category')->get('category/{category}', 'Product\ProductClientController@index');

Route::get('products/{id}', [
    'uses' => 'Product\ProductClientController@show',
    'as' => 'product.show'
]);
//// End User profile
// Shopping Cart
Route::get('/add-to-cart/{id}', [
    'uses' => 'Product\ProductClientController@getAddToCart',
    'as' => 'product.addToCart'
]);
Route::get('reduce/{id}', [
    'uses' => 'Product\ProductClientController@getReduceByOne',
    'as' => 'product.reduceByOne'
]);
Route::get('/remove/{id}', [
    'uses' => 'Product\ProductClientController@getRemoveItem',
    'as' => 'product.remove'
]);
Route::get('/shopping-cart', [
    'uses' => 'Product\ProductClientController@getCart',
    'as' => 'product.shoppingCart'
]);
Route::get('/checkout', [
    'uses' => 'Product\ProductClientController@getCheckout',
    'as' => 'checkout',
    'middleware' => 'auth'
]);
Route::post('/checkout', [
    'uses' => 'Product\ProductClientController@postCheckout',
    'as' => 'checkout',
    'middleware' => 'auth'
]);

////// Admin crud
///// TODO: Setup group middleware, Auth
//Route::group(['prefix' => 'admin', 'as' => 'admin', 'middleware' => 'auth'], function (){
//    Route::resource('products', 'Product\AdminController');
//    Route::resources('categories', 'Categories\AdminController');
//});
