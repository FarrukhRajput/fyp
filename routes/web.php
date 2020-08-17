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

// Home page 
Route::get('/', 'HomeController@index')->name('home');

// Item Catagories
Route::get('/item-catagory', 'ItemCatagoriesContoller@index')->name('catagory.index');
Route::post('/item-catagory', 'ItemCatagoriesContoller@store')->name('catagory.store');
Route::get('/item-catagory/{catagory}/delete', 'ItemCatagoriesContoller@destroy')->name('catagory.delete');
Route::get('/item-catagory/{catagory}/edit', 'ItemCatagoriesContoller@edit')->name('catagory.edit');

// Raw items
Route::get('/raw-item' ,'RawItemController@index')->name('rawItem.index');
Route::post('/raw-item' ,'RawItemController@store')->name('rawItem.store');
Route::get('/raw-item/{id}/edit' ,'RawItemController@edit')->name('rawItem.edit');
Route::get('/raw-item/all' ,'RawItemController@all')->name('rawItem.all');
Route::get('/raw-item/{rawitem}/delete' ,'RawItemController@destroy')->name('rawItem.destroy');

// Vendors

Route::prefix('/vendor')->group( function(){
    Route::get('/all' ,'VendorsController@index')->name('vendor.index');
    Route::get('/{vendor}/edit','VendorsController@edit')->name('vendor.edit');
    Route::get('/{vendor}/delete','VendorsController@destroy')->name('vendor.delete');
    Route::get('/create','VendorsController@create')->name('vendor.create');
    Route::post('/create' ,'VendorsController@store')->name('vendor.store');
    Route::get('/{id}/allProducts' , 'VendorsController@allVendorProducts')->name('vendor.allVendorProducts');
});




// EMPLOYEES
Route::get('/employees','EmployeesController@index')->name('employee.index');
Route::get('/employees/form','EmployeesController@form')->name('employee.form');
Route::get('/employee/{id}/show','EmployeesController@show')->name('employee.show');
Route::post('/employees/form','EmployeesController@store')->name('employee.store');
Route::get('/employee/{id}/destroy','EmployeesController@destroy')->name('employee.destroy');

// STAFF GROUP PAGE

Route::get('/staff-group','StaffGroupController@index')->name('staff.index');
Route::post('/staff-group','StaffGroupController@store')->name('staff.store');
Route::get('/staff-group/{group}/edit','StaffGroupController@show')->name('staff.show');
Route::get('/staff-group/{group}/destroy','StaffGroupController@destroy')->name('staff.destroy');
Route::get('/staff-group/{group}/force-delete','StaffGroupController@forceDelete')->name('staff.forceDelete');
Route::post('/staff-group/{group}/update','StaffGroupController@update')->name('staff.update');

Route::get('/staff-group/getDesignation/{id}','StaffGroupController@getDesignation')->name('staff.getDesignation');

// DESIGNATION PAGE
Route::get('/designation','DesignationController@index')->name('designation.index');
Route::get('/designation/{id}/edit','DesignationController@show')->name('designation.show');
Route::get('/designation/{id}/destroy','DesignationController@destroy')->name('designation.destroy');
Route::post('/designation','DesignationController@store')->name('designation.store');


// Menu Catagories
Route::resource('/menu-categories', 'MenuCategoriesController')->names([
    'index' => 'menuCatagory.index',
    'store' => 'menuCatagory.store',
    'create' => 'menuCatagory.create',
    'edit' => 'menuCatagory.edit',
    'update' => 'menuCatagory.update',
    'destroy' => 'menuCatagory.destroy'
]);



Route::prefix('products')->group( function(){
    Route::get('/all' ,'ProductController@show')->name('products.all');
    Route::get('/create' ,'ProductController@create')->name('products.create');
    Route::post('/create' ,'ProductController@store')->name('products.store');
});



Route::prefix('purchase')->group( function(){
    Route::get('/all' ,'PurchaseController@index')->name('purchase.index');
    Route::get('/create' ,'PurchaseController@create')->name('purchase.create');
});

// // Products
// Route::resource('/products' , 'ProductController')->names([
//     'create' => 'products.create',
//     'store' =>  'products.store',
//     'allProducts' => 'products.index'    
// ]);

