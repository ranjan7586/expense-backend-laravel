<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);
Route::post('/v1/create-user', [UserController::class, 'store']);
// Route::group(['middleware' => ['auth:sanctum']], function ($router) {

// })
Route::group(['middleware' => ['auth.jwt'], 'prefix' => 'v1'], function ($router) {
    Route::get('/get-users', [UserController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Route::post('/payment/create',[PaymentController::class, 'store']);
    Route::post('/payments/create', [PaymentController::class, 'store']);
    Route::post('/payments/get-payments', [PaymentController::class, 'index']);
    Route::post('/payments/get-total-payment', [PaymentController::class, 'getTotalPayment']);
    Route::get('/payments/get-payment-details/{paymentId}', [PaymentController::class, 'show']);
});
