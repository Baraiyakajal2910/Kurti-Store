<?php

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

Route::get('/', function () {
    return view('welcome');
});




Route::group(['prefix'=>'admin'],function(){

	// Route::group(['middleware'=>['web','auth','role:1']],function(){

	
		Route::get('index',function(){
		  	return view('layouts.admin.index');
		  });

		Route::group(['prefix'=>'user'],function(){

			Route::get('index','Usercontroller@index');

			Route::get('update/{id}','Usercontroller@update');

			Route::get('trash','Usercontroller@showTrashUsers');

			Route::get('restore/{id}','Usercontroller@restoreUser');

		});


		Route::group(['prefix'=>'color'],function(){

			Route::get('add','Colorcontroller@showColorAddForm'); 

			Route::post('store','Colorcontroller@store');

			Route::get('update/{id}','Colorcontroller@update');

			Route::post('edit/{id}','Colorcontroller@edit');

			Route::get('show','Colorcontroller@show');

			Route::get('trash','Colorcontroller@showTrashColor');

			Route::get('restore/{id}','Colorcontroller@restoreColor');

			Route::get('showEditForm/{id}','Colorcontroller@showEditForm');

			Route::get('checkname','Colorcontroller@checkName');

			Route::get('changeStatus','Colorcontroller@changeStatus');

		});



		Route::group(['prefix'=>'categories'],function(){

			Route::get('add','Categorycontroller@showCategoryAddForm'); 

			Route::post('store','Categorycontroller@store');

			Route::get('update/{id}','Categorycontroller@update');

			Route::post('edit/{id}','Categorycontroller@edit');

			Route::get('show','Categorycontroller@show');

			Route::get('trash','Categorycontroller@showTrashCategory');

			Route::get('restore/{id}','Categorycontroller@restoreCategory');

			Route::get('showEditForm/{id}','Categorycontroller@showEditForm');

			Route::get('checkBrandname','Categorycontroller@checkBrandname');

			Route::get('changeBrandStatus','Categorycontroller@changeBrandStatus');
		});



		Route::group(['prefix'=>'product'],function(){

			Route::get('add','Productcontroller@showProductAddForm');

			Route::post('store','Productcontroller@store');

			Route::get('update/{id}','Productcontroller@update');

			Route::post('edit/{id}','Productcontroller@edit');

			Route::get('trash','Productcontroller@showTrashProduct');

			Route::get('restore/{id}','Productcontroller@restoreProduct');

			Route::get('showEditForm/{id}','Productcontroller@showEditForm');

			Route::get('show','Productcontroller@show');

			Route::get('checkUpc','Productcontroller@checkUpc');

			Route::get('checkUrl','Productcontroller@checkUrl');

			Route::get('changeProductStatus','Productcontroller@changeProductStatus');

		// Route::get('removeImg','Productcontroller@removeImg');

		});

		Route::group(['prefix'=>'order'],function(){

			Route::get('show','Ordercontroller@showOrder');

			Route::get('details','Ordercontroller@showOrderDetails');

			Route::get('ChangeStatus','Ordercontroller@ChangeStatus');

		});

	// });

	Route::get('user/changeUserStatus','Usercontroller@changeUserStatus');

	Route::get('login','Auth\LoginController@showAdminLoginForm')->name('admin/login');  

	Route::post('login','Auth\LoginController@login');	

	Route::get('logout','Auth\LoginController@logout');

});

// Route::get('admin/index',function(){
//  	return view('layouts.admin.index');
//  })->middleware(['auth','role:1']);
	
		Route::get('/',function(){
		 	return view('layouts.front.index');
		 });

		Route::get('myOrders','Ordercontroller@myOrders');

		Route::get('products','Listcontroller@showList');

		Route::get('orders','Checkoutcontroller@MyOrders');

		Route::get('reset','Auth\ForgotPasswordController@showLinkRequestForm');

		Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail');

		Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm');

		Route::post('password/reset','Auth\ResetPasswordController@reset');
		
		Route::get('register',function(){
		  	return view('layouts.front.auth.register');
		  	  });

		Route::post('store','Auth\RegisterController@store');

		Route::get('front/checkEmail','Auth\RegisterController@checkEmail');

		Route::get('front/checkUsername','Auth\LoginController@checkUsername');

		Route::get('login','Auth\LoginController@showLoginForm')->name('login');

		Route::post('login','Auth\LoginController@login');

		Route::get('logout','Auth\LoginController@logout');

		Route::get('product/sort','Listcontroller@sort');

		Route::get('product/cart','Listcontroller@showMyCart');

		Route::get('product/addToCart','Listcontroller@addToCart');

		Route::get('product/updateCart','Listcontroller@updateCart');

		Route::get('product/order/details','Checkoutcontroller@Orderdetails');

		Route::get('product/order/billing','Checkoutcontroller@billingAddress');

		Route::get('product/order/billing/{id}','Checkoutcontroller@editBillingAddress');

		Route::post('product/order/b_add','Checkoutcontroller@bAddress');

		Route::post('product/order/oldBadd','Checkoutcontroller@oldBadd');

		// Route::post('product/order/updateBadd','Checkoutcontroller@updateBadd');

		Route::get('product/order/shipping','Checkoutcontroller@shipping');

		Route::get('product/order/shipping/{id}','Checkoutcontroller@editShippingAddress');

		Route::post('product/order/s_add','Checkoutcontroller@sAddress');

		Route::post('product/order/oldSadd','Checkoutcontroller@oldSadd');

		// Route::post('product/order/updateSadd','Checkoutcontroller@updateSadd');

		Route::get('product/order/orderReview','Checkoutcontroller@details');

		Route::post('product/placeOrder','Checkoutcontroller@placeOrder');

		Route::get('/{access_url}','Listcontroller@showDetailForm');