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
Route::prefix('admin')->name('admin.')->group(function (){
    Route::resource('profile', 'Admin\ProfileController');
});
Route::prefix('admin')->name('admin.')->group(function (){
    Route::resource('clients', 'Admin\ClientController');
});
Route::prefix('admin')->name('admin.')->group(function (){
    Route::resource('payments', 'Admin\PaymentController');
});
Route::prefix('admin')->name('admin.')->group(function (){
    Route::resource('invoices', 'Admin\InvoiceController');
    Route::get('invoices/{id}/generate-pdf','Admin\InvoiceController@generatePDF')->name('invoices.generate-pdf');

});
Route::prefix('admin')->name('admin.')->group(function (){
    Route::resource('products', 'Admin\ProductController');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/invoice/preview', 'Admin\ProfileController@previewInvoice');
