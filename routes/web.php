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

// Route::get('/', function () {
//     return view('frontend.layouts.index');
// });

Auth::routes();
//deshboard
Route::get('/home', 'HomeController@index')->name('home');

// Frontend Route
Route::get('/','Frontend\FrontendController@index');

//Backend
Route::group(['middleware'=>'auth'],function(){

	Route::prefix('users')->group(function(){
		Route::get('/view','Backend\UsersController@view')->name('users.view');
		Route::get('/add','Backend\UsersController@add')->name('users.add');
		Route::post('/store','Backend\UsersController@store')->name('users.store');
		Route::get('/edit/{id}','Backend\UsersController@edit')->name('users.edit');
		Route::post('/update/{id}','Backend\UsersController@update')->name('users.update');
		Route::post('/delete','Backend\UsersController@delete')->name('users.delete');
	});

	Route::prefix('profile')->group(function(){
		Route::get('/view','Backend\ProfileController@view')->name('profile.view');
		Route::get('/edit','Backend\ProfileController@edit')->name('profile.edit');
		Route::post('/update','Backend\ProfileController@update')->name('profile.update');
		Route::get('/password/view','Backend\ProfileController@password_view')->name('profile.password_view');
		Route::post('/password/update','Backend\ProfileController@password_update')->name('profile.password_update');
	});

	Route::prefix('suppliers')->group(function(){
		Route::get('/view','Backend\SupplierController@view')->name('suppliers.view');
		Route::get('/add','Backend\SupplierController@add')->name('suppliers.add');
		Route::post('/store','Backend\SupplierController@store')->name('suppliers.store');
		Route::get('/edit/{id}','Backend\SupplierController@edit')->name('suppliers.edit');
		Route::post('/update/{id}','Backend\SupplierController@update')->name('suppliers.update');
		Route::post('/delete','Backend\SupplierController@delete')->name('suppliers.delete');
	});

	Route::prefix('customers')->group(function(){
		Route::get('/view','Backend\CustomerController@view')->name('customers.view');
		Route::get('/add','Backend\CustomerController@add')->name('customers.add');
		Route::post('/store','Backend\CustomerController@store')->name('customers.store');
		Route::get('/edit/{id}','Backend\CustomerController@edit')->name('customers.edit');
		Route::post('/update/{id}','Backend\CustomerController@update')->name('customers.update');
		Route::post('/delete','Backend\CustomerController@delete')->name('customers.delete');
		Route::get('/credit/customer','Backend\CustomerController@creditCustomer')->name('customers.credit');
		Route::get('/credit/customer/pdf','Backend\CustomerController@creditCustomerPdf')->name('customers.credit.pdf');
		Route::get('/invoice/edit/{invoice_id}','Backend\CustomerController@editInvoice')->name('customers.edit.invoice');
		Route::post('/invoice/update/{invoice_id}','Backend\CustomerController@updateInvoice')->name('customers.update.invoice');
		Route::get('/invoice/details/pdf/{invoice_id}','Backend\CustomerController@invoiceDetailPdf')->name('customers.datails.invoice.pdf');
		Route::get('/paid/customer','Backend\CustomerController@PaidCustomer')->name('customers.paid');
		Route::get('/paid/customer/pdf','Backend\CustomerController@PaidCustomerPdf')->name('customers.paid.Pdf');	
		Route::get('/custtomer/wise/report','Backend\CustomerController@CustomerWiserReport')->name('customers.wise.report');
		Route::get('/credit/wise/pdf','Backend\CustomerController@CustomerCreditWiserPdf')->name('customers.credit.wise.pdf');
		Route::get('/paid/wise/pdf','Backend\CustomerController@CustomerPaidWiserPdf')->name('customers.paid.wise.pdf');
		
});

	Route::prefix('units')->group(function(){
		Route::get('/view','Backend\UnitController@view')->name('units.view');
		Route::get('/add','Backend\UnitController@add')->name('units.add');
		Route::post('/store','Backend\UnitController@store')->name('units.store');
		Route::get('/edit/{id}','Backend\UnitController@edit')->name('units.edit');
		Route::post('/update/{id}','Backend\UnitController@update')->name('units.update');
		Route::post('/delete','Backend\UnitController@delete')->name('units.delete');
	});

		Route::prefix('categories')->group(function(){
		Route::get('/view','Backend\CategoryController@view')->name('categories.view');
		Route::get('/add','Backend\CategoryController@add')->name('categories.add');
		Route::post('/store','Backend\CategoryController@store')->name('categories.store');
		Route::get('/edit/{id}','Backend\CategoryController@edit')->name('categories.edit');
		Route::post('/update/{id}','Backend\CategoryController@update')->name('categories.update');
		Route::post('/delete','Backend\CategoryController@delete')->name('categories.delete');
	});

	Route::prefix('products')->group(function(){
		Route::get('/view','Backend\ProductController@view')->name('products.view');
		Route::get('/add','Backend\ProductController@add')->name('products.add');
		Route::post('/store','Backend\ProductController@store')->name('products.store');
		Route::get('/edit/{id}','Backend\ProductController@edit')->name('products.edit');
		Route::post('/update/{id}','Backend\ProductController@update')->name('products.update');
		Route::post('/delete','Backend\ProductController@delete')->name('products.delete');
	});

	Route::prefix('purchases')->group(function(){
		Route::get('/view','Backend\PurchaseController@view')->name('purchases.view');
		Route::get('/add','Backend\PurchaseController@add')->name('purchases.add');
		Route::post('/store','Backend\PurchaseController@store')->name('purchases.store');
		// Route::get('/delete/{id}','Backend\PurchaseController@delete')->name('purchases.delete');
		Route::get('/pending','Backend\PurchaseController@pendingList')->name('purchases.pending.list');
		Route::post('/approved','Backend\PurchaseController@approve')->name('purchases.approved');
		Route::get('/purchase/report','Backend\PurchaseController@purchaseReport')->name('purchases.report');
		Route::get('/purchase/report/pdf','Backend\PurchaseController@purchaseReportPdf')->name('purchases.report.pdf');
	});

//calling ajax 
	Route::get('/get-category','Backend\DeafultController@getCategory')->name('get_category');
	Route::get('/get-product','Backend\DeafultController@getProduct')->name('get_product');
	Route::get('/stock-product','Backend\DeafultController@getProductStock')->name('check-product-stock');

	Route::prefix('invoice')->group(function(){
		Route::get('/view','Backend\InvoiceController@view')->name('invoice.view');
		Route::get('/add','Backend\InvoiceController@add')->name('invoice.add');
		Route::post('/store','Backend\InvoiceController@store')->name('invoice.store');
		Route::post('/delete','Backend\InvoiceController@delete')->name('invoice.delete');
		Route::get('/pending','Backend\InvoiceController@pendingList')->name('invoice.pending.list');
		Route::get('/approved/{id}','Backend\InvoiceController@approve')->name('invoice.approved');
		Route::post('/approval-store/{id}','Backend\InvoiceController@approveStore')->name('invoice.approval.store');
		Route::get('/invoice_Print_List','Backend\InvoiceController@invoice_Print_List')->name('invoice.print.list');
		Route::get('/invoice-print/{id}','Backend\InvoiceController@invoicePrint')->name('invoice.print');
		Route::get('/invoice-report','Backend\InvoiceController@invoiceDailyReport')->name('invoice.daily.report');
		Route::get('/invoice-daily-report-pdf','Backend\InvoiceController@invoiceDailyReportPdf')->name('invoice.daily.report.pdf');

	});

	Route::prefix('stocks')->group(function(){
		Route::get('/report','Backend\StockController@stockreport')->name('stocks.report');
		Route::get('/report/pdf','Backend\StockController@stockreportpdf')->name('stocks.report.pdf');
		Route::get('/repot/supplier/product/wise','Backend\StockController@supplierProudctWise')->name('stocks.report.supplier.product.wise');
		Route::get('/report/supplier/wise/pdf','Backend\StockController@supplierWisePdf')->name('stocks.report.supplier.wise.pdf');
		Route::get('/report/product/wise/pdf','Backend\StockController@ProductWisePdf')->name('stocks.report.product.wise.pdf');
	});


});
