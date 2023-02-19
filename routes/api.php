<?php


use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\RestaurantController;
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

Route::get('restaurants', [RestaurantController::class, 'index']);
Route::get('restaurants/{slug}', [RestaurantController::class, 'show']);
Route::get('categories', [RestaurantController::class, 'categories']);
Route::get('types', [RestaurantController::class, 'types']);

Route::post('purchase', [CartController::class, 'purchase']);

Route::get('order', [CartController::class, 'generate']);
Route::post('order/payment' , [CartController::class, 'makePayment']);

Route::post('/contacts', [LeadController::class, 'store']);

Route::post('checkform', [CartController::class, 'checkForm']);
