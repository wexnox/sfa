<?php
use App\Models\Product;
use Illuminate\Support\Facades\Input;

Auth::routes();
//
//// User profile
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'HomeController@index')->name('profile');
});
//// Main Controller
Route::get('/', [
    'uses' => 'Client\MainController@Index',
    'as' => 'index'
]);
//// Categories Controller
Route::name('category')->get('category/{category}', 'Client\CategoriesController@index');
//// ProductController
Route::get('products/{id}', [
    'uses' => 'Client\ProductController@show',
    'as' => 'product.show'
]);

// Cart Controller
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
//// Order Controller
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
// TODO: Move to its own controller
Route::any ( '/search', function () {
    $q = Input::get ( 'q' );
    $Product = Product::where ( 'title', 'LIKE', '%' . $q . '%' )->get ();
    if (count ( $Product ) > 0)
        return view ( 'partials.search' )->withDetails ( $Product )->withQuery ( $q );
    else
        return view ( 'partials.search' )->withMessage ( 'No Details found. Try to search again !' );
} );
