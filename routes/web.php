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






Route::get('','Frontend\HomeController@getIndex' );
Route::get('about', 'Frontend\HomeController@getAbout');
Route::get('contact','Frontend\HomeController@getContact');


//cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('', 'Frontend\CartController@getCart');
});

// checkout
Route::group(['prefix' => 'checkout'], function () {
    Route::get('', 'Frontend\CheckoutController@getCheckout');
    Route::get('complete', 'Frontend\CheckoutController@getComplete');
});

// product
Route::group(['prefix' => 'product'], function () {
    Route::get('shop','Frontend\ProductController@getShop' );
    Route::get('detail','Frontend\ProductController@getDetail' );
});




// ---------------BACKEND

Route::get('login','Backend\LoginController@getLogin'); 


Route::group(['prefix' => 'admin'], function () {

    Route::get('','Backend\IndexController@getIndex'); 

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('','Backend\CategoryController@getCategory');
        Route::post('','Backend\CategoryController@postCategory');
        Route::get('edit','Backend\CategoryController@getEditCategory');
    });

    //order
    Route::group(['prefix' => 'order'], function () {
        Route::get('','Backend\OrderController@getOrder');
        Route::get('detail','Backend\OrderController@getDetailOrder');
        Route::get('processed','Backend\OrderController@getProcessed');
    });

    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('','Backend\ProductController@getListProduct');
        Route::get('add','Backend\ProductController@getAddProduct');
        Route::get('edit','Backend\ProductController@getEditProduct');
    });

    //user
    Route::group(['prefix' => 'user'], function () {
        Route::get('','Backend\UserController@getListUser');
        Route::get('add','Backend\UserController@getAddUser');
        Route::get('edit','Backend\UserController@getEditUser');
    });
    
});


