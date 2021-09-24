<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('invoices', 'InvoicesController');

Route::resource('sections', 'SectionsController');

Route::resource('products', 'ProductsController');

Route::get('/section/{id}', 'InvoicesController@getProducts');

Route::get('/invoiceDetails/{id}', 'InvoiceDetailsController@edit');

Route::get('/view_file/{invoice_number}/{file_name}', 'InvoiceDetailsController@viewFile');

Route::get('/download/{invoice_number}/{file_name}', 'InvoiceDetailsController@downloadFile');

Route::post('delete_file', 'InvoiceDetailsController@destroy')->name('delete_file');

Route::get('/{page}', 'AdminController@index');
