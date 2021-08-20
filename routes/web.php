<?php

use Illuminate\Support\Facades\Route;
use Whoops\Run;
//use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\ManageEventController;

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
//create group prefix for articles customer
Route::group(['prefix' => 'articles'], function () {
    Route::get('/', 'ArticleController@index_customer')->name('customer.articles.index');
    Route::get('/{id}', 'ArticleController@show_customer')->name('customer.articles.show');
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
    Route::get('/payment/{code}/cancel', 'TransactionController@payment_cancel')->name('customer.transactions.payment.cancel');

    Route::get('/e-ticket/{code}', 'TransactionController@eticket')->name('customer.transactions.eticket');
});

//create middle ware
Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    //    Route::get('register', [AuthController::class, 'registerView'])->name('register');
    //    Route::post('register', [AuthController::class, 'create']);
    //create group prefix for admin
    // Route::delete('/manageevent/{tahap:id}',  'ManageEventController@destroy')->name('manageevent.destroy');
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('manageevent', ManageEventController::class);
        Route::get('/manageevent/detail/{id}',  'ManageEventController@showDetail')->name('manageevent.showdetail');
        Route::delete('/manageevent/detail/{detail_id}/{user_id}/deletemember',  'ManageEventController@deleteMember')->name('manageevent.deletemember');
        Route::delete('/manageevent/detail/{id}',  'ManageEventController@destroyDetail')->name('manageevent.destroydetail');
        Route::put('/manageevent/detail/{id}',  'ManageEventController@updateDetail')->name('manageevent.updatedetail');
        Route::put('/manageevent/detail/checklist/{id}/togglechecklist',  'ManageEventController@toggleChecklist')->name('manageevent.toggleChecklist');
        Route::delete('/manageevent/detail/checklist/{id}',  'ManageEventController@destroyChecklist')->name('manageevent.destroychecklist');
        Route::post('/manageevent/detail/checklist/',  'ManageEventController@addCheckList')->name('manageevent.addchecklist');
        Route::post('/manageevent/detail/addmember',  'ManageEventController@addMember')->name('manageevent.addmember');
        Route::post('/manageevent/detail',  'ManageEventController@storeDetail')->name('manageevent.storedetail');
        Route::post('/events/cektanggal', 'EventController@isTanggalMerah');
        Route::get('/events/dashboard', 'EventController@dashboard')->name('events.dashboard');
        Route::resource('events', EventController::class);
        //calendar
        Route::resource('schedule', ScheduleController::class);
        Route::post('/events/action',  'EventController@action');
        Route::resource('articles', ArticleController::class);
        Route::post('/confirmation/{code}', 'TransactionController@confirmation_admin')->name('transactions.confirmation');
        Route::get('/dashboard', 'TransactionController@dashboard')->name('transactions.dashboard');
        Route::resource('transactions', TransactionController::class);
    });
});
