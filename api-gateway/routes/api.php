<?php

use App\Http\Controllers\Api\PresaleController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('products', ProductController::class)->except(['edit', 'create'])->middleware(["throttle:manageSale"]);

Route::resource('sales', SaleController::class)->except(['edit', 'destroy', 'create'])->middleware(["throttle:manageSale"]);

Route::resource('presales', PresaleController::class)->except(['edit', 'destroy', 'update', 'create'])->middleware(["throttle:manageSale"]);
