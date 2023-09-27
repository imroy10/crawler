<?php

use App\Http\Controllers\CrawlerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/welcome', function (Request $request) {
    return 'Hello World!';
});

/**
 * crawler
 */
Route::group(['middleware' => 'api', 'prefix' => 'crawler'], function () {
    Route::get('/transfer', [CrawlerController::class, 'transfer']);
    Route::post('/transfer', [CrawlerController::class, 'transfer']);
    Route::get('/detail', [CrawlerController::class, 'transferDetail']);
    Route::post('/detail', [CrawlerController::class, 'transferDetail']);
});
