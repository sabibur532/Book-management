<?php


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');



Route::get('/users', 'HomeController@users');
Route::get('/user/register', 'HomeController@userregister');
Route::post('/user/register/insert', 'HomeController@userregisterinsert');
Route::get('/user/detele/{user_id}', 'HomeController@delete');





Route::get('/customer/view', 'CustomerController@view');
Route::get('/customer/paidview', 'CustomerController@paidview');
Route::get('/customer/dueview', 'CustomerController@dueview');
Route::get('/customer/add', 'CustomerController@add');
Route::post('/customer/add/insert', 'CustomerController@addinsert');
Route::get('/customer/info/{customerId}', 'CustomerController@info');

Route::get('/customer/sale/{id}', 'CustomerController@sale');

//PDF
Route::get('/customer/pdf', 'CustomerController@pdf');
Route::get('/customer/info/pdf/{id}', 'CustomerController@pdfcustomer');



Route::get('/customer/edit/{customerId}', 'CustomerController@edit');
Route::post('/customer/edit/insert', 'CustomerController@editinsert');

Route::get('/books', 'CustomerController@book');
Route::get('/book/add', 'CustomerController@bookadd');
Route::post('/book/add/insert', 'CustomerController@bookaddinsert');

Route::get('/cash', 'CustomerController@cashview');
Route::get('/cash/add', 'CustomerController@cashadd');
Route::post('/cash/add/insert', 'CustomerController@cashaddinsert');

Route::get('/cost', 'CustomerController@costview');
Route::get('/cost/add', 'CustomerController@costadd');
Route::post('/cost/add/insert', 'CustomerController@costaddinsert');
