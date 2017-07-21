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

Route::get('clear-cache',function(){
	Artisan::call('config:clear');
	Artisan::call('view:clear');
	Artisan::call('cache:clear');
	dd('cleared cache files');
});


Route::get('/', 'MasterController@index');
Route::get('category/{slug}', 'MasterController@products');
Route::get('product/{slug}', 'MasterController@productDetail');
Route::get('about', 'MasterController@about');
Route::get('brands', 'MasterController@brands');
Route::get('cart', 'MasterController@cart');
Route::get('privacy', 'MasterController@privacy');
Route::get('terms', 'MasterController@terms');
Route::get('contact', 'MasterController@contact');
Route::post('subscribe', 'MasterController@subscribe');
Route::post('contact', 'MasterController@contactMail');
Route::post('career_mail', 'MasterController@careerMail');
Route::post('product/addtocart','MasterController@addToCart');
Route::post('product/updatecart','MasterController@updateCart');
Route::delete('product/removefromcart','MasterController@removeFromCart');
Route::post('product/checkout','MasterController@checkout');


Route::group([
	'prefix' => 'ar'],function () {
Route::get('/', 'MasterController@index');
Route::get('category/{slug}', 'MasterController@products');
Route::get('product/{slug}', 'MasterController@productDetail');
Route::get('about', 'MasterController@about');
Route::get('brands', 'MasterController@brands');
Route::get('cart', 'MasterController@cart');
Route::get('privacy', 'MasterController@privacy');
Route::get('terms', 'MasterController@terms');
Route::get('contact', 'MasterController@contact');
Route::post('subscribe', 'MasterController@subscribe');
Route::post('contact', 'MasterController@contactMail');
Route::post('career_mail', 'MasterController@careerMail');
Route::post('product/addtocart','MasterController@addToCart');
Route::post('product/updatecart','MasterController@updateCart');
Route::delete('product/removefromcart','MasterController@removeFromCart');
Route::post('product/checkout','MasterController@checkout');
});


Auth::routes();

Route::group([
	'prefix' => 'admin',
	'middleware' => 'auth'], function () {

	Route::get('/', 'DashboardController@index');
	Route::get('dashboard', 'DashboardController@index');
	Route::get('my-account', 'DashboardController@myAccount');
	Route::put('my-account', 'DashboardController@updateAccount');



	Route::get('products','ProductController@index');
	Route::post('products','ProductController@store');
	Route::get('products/add','ProductController@create');
	Route::get('products/edit/{id}','ProductController@create');
	Route::put('products/edit/{id}','ProductController@update');
	Route::post('products/image','ProductController@saveImage');

	Route::get('products/categories','ProductCategoryController@index');
	Route::post('products/categories','ProductCategoryController@store');
	Route::get('products/category/edit/{id}','ProductCategoryController@index');
	Route::put('products/category/edit/{id}','ProductCategoryController@update');
	Route::delete('products/category/{id}','ProductCategoryController@destroy');
	Route::delete('products/category/delete/{id}','ProductCategoryController@forceDestroy');
	Route::post('products/category/image','ProductCategoryController@saveImage');
	Route::post('products/categories/sort','ProductCategoryController@sort');


	Route::get('news','NewsController@index');
	Route::get('news/add','NewsController@create');
	Route::post('news','NewsController@store');
	Route::get('news/edit/{id}','NewsController@edit');
	Route::delete('news/image','NewsController@deleteImage');
	Route::post('news/image','NewsController@saveImage');
	Route::put('news/{id}','NewsController@update');
	Route::delete('news/{id}','NewsController@destroy');
	

	Route::get('brands','BrandController@index');
	Route::get('brands/add','BrandController@create');
	Route::post('brands','BrandController@store');
	Route::get('brands/edit/{id}','BrandController@edit');
	Route::delete('brands/image','BrandController@deleteImage');
	Route::post('brands/image','BrandController@saveImage');
	Route::put('brands/{id}','BrandController@update');
	Route::delete('brands/{id}','BrandController@destroy');
	Route::post('brands/sort','BrandController@sort');
	

	Route::get('terms','TermsController@index');
	Route::get('terms/add','TermsController@create');
	Route::post('terms','TermsController@store');
	Route::get('terms/edit/{id}','TermsController@edit');
	Route::put('terms/{id}','TermsController@update');
	Route::delete('terms/{id}','TermsController@destroy');


	Route::get('privacy','PrivacyController@index');
	Route::get('privacy/add','PrivacyController@create');
	Route::post('privacy','PrivacyController@store');
	Route::get('privacy/edit/{id}','PrivacyController@edit');
	Route::put('privacy/{id}','PrivacyController@update');
	Route::delete('privacy/{id}','PrivacyController@destroy');




	Route::get('subscribers', 'SubscribersController@index');
	Route::delete('subscribers/{id}','SubscribersController@destroy');
	
	});
