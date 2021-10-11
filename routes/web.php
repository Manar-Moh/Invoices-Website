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

Route::resource('invoiceAttachments', 'InvoicesAttachmentsController');

Route::get('/edit_invoice/{id}', 'InvoicesController@edit');

Route::get('/payment_change/{id}', 'InvoicesController@show');

Route::resource('invoiceDetails', 'InvoiceDetailsController');

Route::get('invoice_paid', 'InvoicesController@invoice_paid');

Route::get('invoice_partially_paid', 'InvoicesController@invoice_partially_paid');

Route::get('invoice_non_paid', 'InvoicesController@invoice_non_paid');

Route::resource('invoicesArchieve', 'InvoicesArchieveController');

Route::get('print_invoice/{id}', 'InvoicesController@print_invoice');

Route::get('export_invoice', 'InvoicesController@export');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
});

Route::get('invoices_report', 'Invoices_Report@index');

Route::post('Search_invoices', 'Invoices_Report@Search_invoices');

Route::get('/{page}', 'AdminController@index');
