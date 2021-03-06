<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();
Route::get('confirm', [HomeController::class, 'confirm']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/paid/{id}/status/{status}', [HomeController::class, 'updateOrder'])->name('update');
Route::get('/paid-orders', [HomeController::class, 'paidOrders']);
Route::get('history', [HomeController::class, 'history']);
Route::post('send-notification', [HomeController::class, 'sendWebNotification'])->name('sendWebNotification');
