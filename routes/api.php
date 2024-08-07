<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NftController;

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

Route::post('get_nft', [NftController::class, 'getNft']);
Route::post('get_category', [NftController::class, 'getCategory']);
Route::post('get_sub_category', [NftController::class, 'getSubCategory']);
Route::post('add_volume', [NftController::class, 'addVolume']);