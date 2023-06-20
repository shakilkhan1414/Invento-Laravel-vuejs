<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\HomeController;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

Route::apiResource('/employee', EmployeeController::class);
Route::apiResource('/supplier', SupplierController::class);
Route::apiResource('/customer', CustomerController::class);
Route::apiResource('/category', CategoryController::class);
Route::apiResource('/product', ProductController::class);
Route::apiResource('/expense', ExpenseController::class);
Route::apiResource('/salary', SalaryController::class);


Route::post('/salary/pay/{id}', [SalaryController::class, 'paySalary']);

Route::get('/addToCart/{id}', [CartController::class, 'addToCart']);
Route::get('/cart/products', [CartController::class, 'cartProducts']);
Route::get('/cart/remove/{id}', [CartController::class, 'removeCart']);
Route::get('/cart/increment/{id}', [CartController::class, 'increment']);
Route::get('/cart/decrement/{id}', [CartController::class, 'decrement']);
Route::post('/order/complete', [CartController::class, 'order']);

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/order/view/{id}', [OrderController::class, 'show']);
Route::get('/order/orderDetails/{id}', [OrderController::class, 'orderDetails']);

Route::get('/statistics', [HomeController::class, 'statistics']);



