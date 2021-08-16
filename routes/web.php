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

Route::get('/', 'EventController@index_customer')->name('customer.events.index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

//create group prefix for events customer
Route::group(['prefix' => 'events'], function () {
    Route::get('/{id}', 'EventController@show_customer')->name('customer.events.show');
});

//group for transactions ticket
Route::group(['prefix' => 'transactions'], function () {

    Route::get('/ticketing', 'TransactionController@ticketing')->name('customer.transactions.ticketing');
    Route::post('/ticketing/search', 'TransactionController@ticketing_search')->name('customer.transactions.ticketing.search');
    Route::get('/ticketing/{code}', 'TransactionController@ticketing_show')->name('customer.transactions.ticketing.show');

    Route::get('/{event_id}/confirmation', 'TransactionController@confirmation')->name('customer.transactions.confirmation');
    Route::post('/{event_id}/confirmation/process', 'TransactionController@confirmation_process')->name('customer.transactions.confirmation.process');

    Route::get('/checkout/{code}', 'TransactionController@checkout')->name('customer.transactions.checkout');
    Route::post('/checkout/{code}/process', 'TransactionController@checkout_process')->name('customer.transactions.checkout.process');

    Route::get('/payment/{code}', 'TransactionController@payment')->name('customer.transactions.payment');
    Route::post('/payment/{code}/process', 'TransactionController@payment_process')->name('customer.transactions.payment.process');

    Route::get('/e-ticket/{code}', 'TransactionController@eticket')->name('customer.transactions.eticket');
});

//create middle ware
Route::group(['middleware' => 'auth'], function () {
    //create group prefix for admin
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('events', EventController::class);

        Route::post('/confirmation/{code}', 'TransactionController@confirmation_admin')->name('transactions.confirmation');
        Route::get('/dashboard', 'TransactionController@dashboard')->name('transactions.dashboard');
        Route::resource('transactions', TransactionController::class);
    });
});