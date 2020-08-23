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


// STAFF GROUP PAGE()Tested
Route::prefix('/staff-groups')->group( function() {
    Route::get('/','StaffGroupController@index')->name('staff.index');
    Route::post('/','StaffGroupController@store')->name('staff.store');
    Route::get('/{group}/edit','StaffGroupController@edit')->name('staff.edit');
    Route::get('/{group}/destroy','StaffGroupController@destroy')->name('staff.destroy');
    Route::get('/{group}/force-delete','StaffGroupController@forceDelete')->name('staff.forceDelete');
    Route::get('/{group}/getDesignations','StaffGroupController@getDesignations')->name('staff.getDesignation');
});


// DESIGNATION PAGE (Tested)
Route::prefix('/designations')->group( function() {
    Route::get('/','DesignationController@index')->name('designation.index');
    Route::post('/','DesignationController@store')->name('designation.store');
    Route::get('/{id}/edit','DesignationController@show')->name('designation.show');
    Route::get('/{id}/destroy','DesignationController@destroy')->name('designation.destroy');
});


// EMPLOYEES
Route::prefix('employees')->group( function() {
    Route::get('/','EmployeesController@index')->name('employee.index');
    Route::get('/create','EmployeesController@create')->name('employee.create');
    Route::post('/employees/form','EmployeesController@store')->name('employee.store');
    Route::get('/{id}/edit','EmployeesController@edit')->name('employee.edit');
    Route::get('/{id}/destroy','EmployeesController@destroy')->name('employee.destroy');
});



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
    Route::get('/edit/{id}' ,'ProductController@edit')->name('products.edit');
    Route::get('/update/{id}' ,'ProductController@update')->name('products.update');
    Route::get('/delete/{id}' ,'ProductController@destroy')->name('products.destroy');
    Route::post('/create' ,'ProductController@store')->name('products.store');
});



Route::prefix('purchase')->group( function(){
    Route::get('/all' ,'PurchaseController@index')->name('purchase.index');
    Route::get('/create' ,'PurchaseController@create')->name('purchase.create');
});


// Table

Route::prefix('table')->group( function(){
    // Route::get('/store' ,'TableController@store')->name('TableController.store');
    Route::get('/all' ,'TableController@all')->name('table.all');
   
});


// 
Route::prefix('system_users')->group( function(){
    Route::get('/all' ,'SystemUserController@index')->name('system_users.index');
    // Route::get('/create' ,'PurchaseController@create')->name('purchase.create');
});




// Route::resource('/products' , 'ProductController')->names([
//     'create' => 'products.create',
//     'store' =>  'products.store',
//     'allProducts' => 'products.index'    
// ]);

