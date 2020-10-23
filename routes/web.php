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


Auth::routes();
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('key:generate');
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    // return what you want
    return 'تم بنجاح';
});

Route::get('/migrate', function () {
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');

    // return what you want
    return 'تم بنجاح';
});


Route::get('lang/{lang}', function ($lang) {

    App::setLocale($lang);
    session()->put('lang', $lang);
    return redirect()->back();
})->name('lang');
Route::middleware('auth')->group(function () {
    // Route::get('/', 'HomeController');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('home', 'HomeController@index');
    Route::get('pdf', 'HomeController@pdf');
    Route::post('ajax', 'HomeController@ajax')->name('ajax');

    Route::resource('department', 'DepartmentController');
    Route::get('departments/data', 'DepartmentController@getCustomFilterData')->name('department.data');

    Route::resource('manage_users', 'UserController')->except('show', 'edit', 'update', 'destroy');
    Route::get('manage_users/{user}', 'UserController@show');
    Route::put('manage_users/{user}', 'UserController@update');
    Route::delete('manage_users/{user}', 'UserController@destroy');
    Route::get('manage_user/data', 'UserController@getCustomFilterData')->name('manage_users.data');

    Route::get('manage_users/{user}/edit', 'UserController@edit')->name('manage_users.edit');
    Route::get('profile', 'UserController@profile')->name('profile');

    ////////////////////////////// Route::resource('suppler','SupplerController');
    Route::resource('suppler', 'SupplersController');
    Route::get('supplers/data', 'SupplersController@getCustomFilterData')->name('suppler.data');

    Route::resource('client', 'ClientsController');
    Route::get('clients/data', 'ClientsController@getCustomFilterData')->name('client.data');

    Route::resource('warehouse', 'WarehousesController');
    Route::get('warehouses/data', 'WarehousesController@getCustomFilterData')->name('warehouse.data');
    Route::get('warehouses/data2/{name}', 'WarehousesController@getCustomFilterData2')->name('warehouse.data2');

    Route::resource('product', 'ProductsController');
    Route::get('products/data', 'ProductsController@getCustomFilterData')->name('product.data');

    Route::resource('supplerorder', 'SupplerOrderController');
    Route::get('supplerorders/data', 'SupplerOrderController@getCustomFilterData')->name('supplerorder.data');
    Route::get('supplerorders/product/{barcode}', 'SupplerOrderController@getProducts')->name('supplerorder.product');
    Route::get('supplerorders/barcodes/{dataorder}/{product}', 'SupplerOrderController@pdf')->name('supplerorder.barcodes');

    Route::get('supplerorders/Receipt/{barcode}', 'SupplerOrderController@Receipt')->name('supplerorder.Receipt');

    Route::resource('clientorder', 'ClientOrderController');
    Route::get('clientorders/data', 'ClientOrderController@getCustomFilterData')->name('clientorder.data');
    Route::get('clientorders/Approved/{id}', 'ClientOrderController@Approved');
    Route::get('clientorders/stokeman/{id}', 'ClientOrderController@stokeman')->name('clientorder.stokeman');
    Route::get('clientorders/cashing/{barcode}/{orderId}', 'ClientOrderController@Cashing');
    Route::post('clientorders/delivarycompany', 'ClientOrderController@delivarycompany')->name('clientorder.delivarycompany');
    Route::post('clientorders/MltieApproved', 'ClientOrderController@MltieApproved')->name('clientorder.MltieApproved');
    Route::post('clientorders/getPdf', 'ClientOrderController@getPdf')->name('clientorder.getPdf');


    Route::resource('delivarycompany', 'DelivaryCompanyController');
    Route::get('delivarycompanys/data', 'DelivaryCompanyController@getCustomFilterData')->name('delivarycompany.data');
    Route::get('report', 'WarehousesController@ReportOfDeliveryCompany')->name('report');

    Route::resource('delivaryprice', 'DelivaryPriceController');
    Route::get('delivaryprices/{delivaryprice}', 'ClientOrderController@DelivaryPrice');

    Route::resource('governorate', 'GovernoratesController');
    Route::get('governorates/data', 'GovernoratesController@getCustomFilterData')->name('governorate.data');

    Route::resource('city', 'CitiesController');
    Route::get('citys/data', 'CitiesController@getCustomFilterData')->name('city.data');

    // accounting controllers
    //----------------------------- revenue --------------------------------------
    // ============================= revenue bill ===============================
    Route::get('accounting/revenue_bill', 'accounting\revenueController@revenue_bill');
    Route::post('accounting/revenue_bill_post', 'accounting\revenueController@store_revenue_bill')->name('revenue_bill.store');
    //============================= revenue customer orders ====================
    Route::get('accounting/revenue_customer_orders', 'accounting\revenueController@revenue_customer_orders');
    Route::post('accounting/revenue_customer_orders_post', 'accounting\revenueController@store_revenue_customer_orders')->name('revenue_customer.store');
    //============================= revenue shipping company ====================
    Route::get('accounting/revenue_shipping_company', 'accounting\revenueController@revenue_shipping_company');
    Route::post('accounting/revenue_shipping_company_post', 'accounting\revenueController@store_revenue_shipping_company')->name('revenue_shipping.store');

    //----------------------------- expenses --------------------------------------
    // ============================= expenses bill ===============================
    Route::get('accounting/expenses_bill', 'accounting\expensesController@expenses_bill');
    Route::post('accounting/expenses_bill_post', 'accounting\expensesController@store_expenses_bill')->name('expenses_bill.store');
    //============================= expenses customer orders ====================
    Route::get('accounting/expenses_customer_orders', 'accounting\expensesController@expenses_customer_orders');
    Route::post('accounting/expenses_customer_orders_post', 'accounting\expensesController@store_expenses_customer_orders')->name('expenses_customer.store');
    //============================= expenses shipping company ====================
    Route::get('accounting/expenses_shipping_company', 'accounting\expensesController@expenses_shipping_company');
    Route::post('accounting/expenses_shipping_company_post', 'accounting\expensesController@store_expenses_shipping_company')->name('expenses_shipping.store');


    // ----------------------------------------------------------------------------
    //============================= accounting Tree ====================
    Route::get('accounting/tree', 'accounting\treeController@tree');

    //============================= american Journal ====================

    Route::get('americanJournal', 'accounting\americanJournal@americanJournal_fun');

    //============================= trial Balance =======================

    Route::get('trialBalance', 'accounting\trialBalance@trialBalance');


});

