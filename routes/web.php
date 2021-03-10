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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/customers/search', [App\Http\Controllers\CustomerController::class, 'search'])->name('customers.search');
    Route::resource('/customers', App\Http\Controllers\CustomerController::class);

    Route::get('/orders/search', [App\Http\Controllers\OrderController::class, 'search'])->name('orders.search');
    Route::resource('/orders', App\Http\Controllers\OrderController::class);

    Route::get('/analytics-date-range', [App\Http\Controllers\AnalyticsController::class, 'getDateRange'])->name('analytics.date-range');
    Route::get('/analytics', [App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics');

    Route::get('bulk-sms', [\App\Http\Controllers\BulkSMSController::class, 'index'])->name('bulk-sms.index');
    Route::post('bulk-sms', [\App\Http\Controllers\BulkSMSController::class, 'send'])->name('bulk-sms.send');
    Route::get('bulk-sms/balance', [\App\Http\Controllers\BulkSMSController::class, 'balance']);

});
