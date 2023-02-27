<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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



Route::get('/coba', [CategoryController::class, 'cobacoba']);
Route::post('/categories', [CategoryController::class, 'store']);
// Route::post('/products', [ProductController::class, 'store']);
// Route::get('/search', [SearchController::class, 'search']);