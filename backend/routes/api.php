<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StripeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::put('/user/update/{id}', [UserController::class, 'update']);
Route::delete('user/delete/{id}', [UserController::class, 'destroy']);
Route::get('/user/{id}', [UserController::class, 'show']);






Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
 // Create a new product
 Route::post('/products', [ProductController::class, 'store']);

 // Update an existing product
 Route::put('/products/{id}', [ProductController::class, 'update']);

 // Delete a product
 Route::delete('/products/{id}', [ProductController::class, 'destroy']);



Route::post('/cart/add-item', [CartController::class, 'addItem']);
// routes/api.php

Route::get('/cart/{userId}', [CartController::class,'getCartItems']);
Route::delete('/cart/remove-item/{userId}/{productId}', [CartController::class,'removeCartItem']);
Route::put('/cart/increment-item/{userId}/{productId}',  [CartController::class,'incrementCartItem']);
Route::put('/cart/decrement-item/{userId}/{productId}',  [CartController::class,'decrementCartItem']);


Route::post('/stripe', [StripeController::class,'stripePost']);







