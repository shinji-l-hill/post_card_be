<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SendListController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
  return response()->json(['message' => 'Hello, World!']);
});
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::post('/sendlist/register', [SendListController::class, 'store']);
