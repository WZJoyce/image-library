<?php

use App\Http\Controllers\api\ImageController;
use App\Http\Controllers\api\UnsplashController;
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

Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});

Route::get('unsplash', [UnsplashController::class, 'search'])->name('unsplash_search');

Route::post('images', [ImageController::class, 'store'])->name('image');
//Route::apiResource('images', 'ImageController', ['namespace' => 'Api', 'as' => 'api.', 'prefix' => 'api']);
Route::get('images', [ImageController::class, 'index'])->name('image_show');
Route::delete('images/{image}', [ImageController::class, 'destroy'])->name('image_destroy');
Route::get('images/{image}', [ImageController::class, 'highlight'])->name('image_highlight');




