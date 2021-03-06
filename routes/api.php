<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', [UserController::class, 'index']);
Route::post('login', [UserController::class, 'checkLogin']);
Route::post('create', [UserController::class, 'createUser']);
Route::delete('user/{id}', [UserController::class, 'deleteUser']);
Route::put('order/{id}', [UserController::class, 'updateOrder']);
Route::get('orders', [UserController::class, 'getOrders']);
Route::post('items', [UserController::class, 'addItems']);
Route::get('items/{id}', [UserController::class, 'showItems']);
Route::delete('items/{id}', [UserController::class, 'deleteItem']);
