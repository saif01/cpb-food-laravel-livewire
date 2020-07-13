<?php

use Illuminate\Support\Facades\Route;


//User Route Start
Route::livewire('/', 'home')->name('home');
Route::livewire('/posts', 'posts')->name('posts');
Route::livewire('/posts-details/{id}', 'postdetails');
Route::livewire('/products', 'products');
Route::livewire('/products-details/{id}', 'productdetails');
Route::livewire('/outlates/{division}', 'outlates');
//User Route End



Route::namespace('Admin')->prefix('admin')->group(function(){
    Route::get('/', 'LoginController@Index')->name('admin.login');
    Route::post('/login-action', 'LoginController@LoginAction')->name('admin.login.action');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->group(function(){

    Route::get('/dashboard', 'HomeController@Dashboard')->name('admin.dashboard');

    //Role
    Route::namespace('Role')->prefix('role')->group(function(){
        Route::get('/all', 'Rolecontroller@All')->name('role.all');
        Route::post('/store', 'Rolecontroller@Store');
        Route::get('/edit/{id}', 'Rolecontroller@Edit');
        Route::post('/update', 'Rolecontroller@Update');
        Route::get('/delete/{id}', 'Rolecontroller@Delete');
    });

    //User
    Route::namespace('User')->prefix('user')->group(function(){
        Route::get('/all', 'UserController@All')->name('user.all');
        Route::post('/store', 'UserController@Store');
        Route::get('/edit/{id}', 'UserController@Edit');
        Route::post('/update', 'UserController@Update');
        Route::get('/delete/{id}', 'UserController@Delete');

        //Roles
        Route::get('/role-edit/{id}', 'UserController@RoleEdit');
        Route::post('/role-store', 'UserController@RoleStore');
    });

    //Post
    Route::namespace('Post')->prefix('post')->group(function(){
        Route::get('/all', 'PostController@All')->name('post.all');
        Route::post('/store', 'PostController@Store');
        Route::get('/edit/{id}', 'PostController@Edit');
        Route::post('/update', 'PostController@Update');
        Route::get('/delete/{id}', 'PostController@Delete');
        Route::get('/status/{id}/{val}', 'PostController@Status');
    });

    //Product
    Route::namespace('Product')->prefix('product')->group(function(){
        Route::get('/all', 'ProductController@All')->name('product.all');
        Route::post('/store', 'ProductController@Store');
        Route::get('/edit/{id}', 'ProductController@Edit');
        Route::post('/update', 'ProductController@Update');
        Route::get('/delete/{id}', 'ProductController@Delete');
        Route::get('/status/{id}/{val}', 'ProductController@Status');
    });

    //Promotion
    Route::namespace('Promotion')->prefix('promotion')->group(function(){
        Route::get('/all', 'PromotionController@All')->name('promotion.all');
        Route::post('/store', 'PromotionController@Store');
        Route::get('/edit/{id}', 'PromotionController@Edit');
        Route::post('/update', 'PromotionController@Update');
        Route::get('/delete/{id}', 'PromotionController@Delete');
        Route::get('/status/{id}/{val}', 'PromotionController@Status');
    });

    //About
    Route::namespace('About')->prefix('about')->group(function(){
        Route::get('/all', 'AboutController@All')->name('about.all');
        Route::post('/store', 'AboutController@Store');
        Route::get('/edit/{id}', 'AboutController@Edit');
        Route::post('/update', 'AboutController@Update');
        Route::get('/delete/{id}', 'AboutController@Delete');
        Route::get('/status/{id}/{val}', 'AboutController@Status');
    });

    //Contact
    Route::namespace('Contact')->prefix('contact')->group(function(){
        Route::get('/all', 'ContactController@All')->name('contact.all');
        Route::post('/store', 'ContactController@Store');
        Route::get('/edit/{id}', 'ContactController@Edit');
        Route::post('/update', 'ContactController@Update');
        Route::get('/delete/{id}', 'ContactController@Delete');
        Route::get('/status/{id}/{val}', 'ContactController@Status');
    });

    //Outlate
    Route::namespace('Outlate')->prefix('outlate')->group(function(){
        Route::get('/all', 'OutlateController@All')->name('outlate.all');
        Route::post('/store', 'OutlateController@Store');
        Route::get('/edit/{id}', 'OutlateController@Edit');
        Route::post('/update', 'OutlateController@Update');
        Route::get('/delete/{id}', 'OutlateController@Delete');
        Route::get('/status/{id}/{val}', 'OutlateController@Status');
    });

     //Slider
     Route::namespace('Slider')->prefix('slider')->group(function(){
        Route::get('/all', 'SliderController@All')->name('slider.all');
        Route::post('/store', 'SliderController@Store');
        Route::get('/edit/{id}', 'SliderController@Edit');
        Route::post('/update', 'SliderController@Update');
        Route::get('/delete/{id}', 'SliderController@Delete');
        Route::get('/status/{id}/{val}', 'SliderController@Status');
    });


});


