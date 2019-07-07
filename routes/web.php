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
    return view('welcome');
});

Route::get('/','IndexController@index');

Route::match(['get', 'post'], '/admin','AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Products Filters Route
Route::match(['get', 'post'],'/products-filter', 'ProductsController@filter');

// Category/Listing Page
Route::get('/products/{url}','ProductsController@products');

// Product Detail Page
Route::get('/product/{id}','ProductsController@product');

// Cart Page
Route::match(['get', 'post'],'/cart','ProductsController@cart');

// Add to Cart Route
Route::match(['get', 'post'], '/add-cart', 'ProductsController@addtocart');

// Delete Product from Cart Route
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');

// Update Product Quantity from Cart
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

// Get Product Attribute Price
Route::any('/get-product-price','ProductsController@getProductPrice');

// Apply Coupon
Route::post('/cart/apply-coupon','ProductsController@applyCoupon');

// Users Login/Register Page
Route::get('/login-register','UsersController@userLoginRegister');

Route::match(['get','post'],'forgot-password','UsersController@forgotPassword');

// Users Register Form Submit
Route::post('/user-register','UsersController@register');

// Confirm Account
Route::get('confirm/{code}','UsersController@confirmAccount');

// Users Login Form Submit
Route::post('user-login','UsersController@login');

// Users logout
Route::get('/user-logout','UsersController@logout'); 

// Search Products
Route::post('/search-products','ProductsController@searchProducts');

// Check if User already exists
Route::match(['GET','POST'],'/check-email','UsersController@checkEmail');

// Check Pincode
Route::post('/check-pincode','ProductsController@checkPincode');

// All Routes after Login
Route::group(['middleware'=>['frontlogin']],function(){
	// Users Account Page
	Route::match(['get','post'],'account','UsersController@account');
	// Check User Current Password
	Route::post('/check-user-pwd','UsersController@chkUserPassword');
	// Update User Password
	Route::post('/update-user-pwd','UsersController@updatePassword');
	// Checkout Page
	Route::match(['get','post'],'checkout','ProductsController@checkout');
	// Order Review Page
	Route::match(['get','post'],'/order-review','ProductsController@orderReview');
	// Place Order
	Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
	// Thanks Page
	Route::get('/thanks','ProductsController@thanks');
	// Paypal Page
	Route::get('/paypal','ProductsController@paypal');
	// Users Orders Page
	Route::get('/orders','ProductsController@userOrders');
	// User Ordered Products Page
	Route::get('/orders/{id}','ProductsController@userOrderDetails');
	// Paypal Thanks Page
	Route::get('/paypal/thanks','ProductsController@thanksPaypal');
	// Paypal Cancel Page
	Route::get('/paypal/cancel','ProductsController@cancelPaypal');
});


Route::group(['middleware' => ['adminlogin']], function () {
	Route::get('/admin/dashboard','AdminController@dashboard');	
	Route::get('/admin/settings','AdminController@settings');
	Route::get('/admin/check-pwd','AdminController@chkPassword');
	Route::match(['get', 'post'],'/admin/update-pwd','AdminController@updatePassword');

	// Admin Categories Routes
	Route::match(['get', 'post'], '/admin/add-category','CategoryController@addCategory');
	Route::match(['get', 'post'], '/admin/edit-category/{id}','CategoryController@editCategory');
	Route::match(['get', 'post'], '/admin/delete-category/{id}','CategoryController@deleteCategory');
	Route::get('/admin/view-categories','CategoryController@viewCategories');

	// Admin Products Routes
	Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
	Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
	Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');
	Route::get('/admin/view-products','ProductsController@viewProducts');
	Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
	Route::get('/admin/delete-product-video/{id}','ProductsController@deleteProductVideo');
	
	Route::match(['get', 'post'], '/admin/add-images/{id}','ProductsController@addImages');
	Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteProductAltImage');

	// Admin Attributes Routes
	Route::match(['get', 'post'], '/admin/add-attributes/{id}','ProductsController@addAttributes');
	Route::match(['get', 'post'], '/admin/edit-attributes/{id}','ProductsController@editAttributes');
	Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttribute');

	// Admin Coupon Routes
	Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
	Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
	Route::get('/admin/view-coupons','CouponsController@viewCoupons');
	Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');

	// Admin Banners Routes
	Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');
	Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
	Route::get('admin/view-banners','BannersController@viewBanners');
	Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');

	// Admin Orders Routes
	Route::get('/admin/view-orders','ProductsController@viewOrders');

	// Admin Order Details Route
	Route::get('/admin/view-order/{id}','ProductsController@viewOrderDetails');

	// Order Invoice
	Route::get('/admin/view-order-invoice/{id}','ProductsController@viewOrderInvoice');

	// Update Order Status
	Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');

	// Admin Users Route
	Route::get('/admin/view-users','UsersController@viewUsers');

	// Add CMS Route 
	Route::match(['get','post'],'/admin/add-cms-page','CmsController@addCmsPage');

	// Edit CMS Route
	Route::match(['get','post'],'/admin/edit-cms-page/{id}','CmsController@editCmsPage');

	// View CMS Pages Route
	Route::get('/admin/view-cms-pages','CmsController@viewCmsPages');

	// Delete CMS Route 
	Route::get('/admin/delete-cms-page/{id}','CmsController@deleteCmsPage');

	// Get Enquiries
	Route::get('/admin/get-enquiries','CmsController@getEnquiries');

	// View Enquiries
	Route::get('/admin/view-enquiries','CmsController@viewEnquiries');

	// Currencies Routes
	// Add Currency Route
	Route::match(['get','post'],'/admin/add-currency','CurrencyController@addCurrency');

	// Edit Currency Route
	Route::match(['get','post'],'/admin/edit-currency/{id}','CurrencyController@editCurrency');

	// Delete Currency Route
	Route::get('/admin/delete-currency/{id}','CurrencyController@deleteCurrency');

	// View Currencies Route
	Route::get('/admin/view-currencies','CurrencyController@viewCurrencies');

	// View Shipping Charges
	Route::get('/admin/view-shipping','ShippingController@viewShipping');

	// Update Shipping Charges
	Route::match(['get','post'],'/admin/edit-shipping/{id}','ShippingController@editShipping');
});


Route::get('/logout','AdminController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Display Contact Page
Route::match(['get','post'],'/page/contact','CmsController@contact');

// Display Post Page (for Vue.js)
Route::match(['get','post'],'/page/post','CmsController@addPost');

// Display CMS Page
Route::match(['get','post'],'/page/{url}','CmsController@cmsPage');
