<?php

use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => [
        'api',
    ],
], function () {
    Route::prefix('v1')->name('api.v1.')->group(function () {
        Route::apiResource('products', ProductController::class)->only(['index']);
    });
});
