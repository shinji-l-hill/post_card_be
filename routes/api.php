<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SendListController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
  return response()->json(['message' => 'Hello, World!']);
});
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::post('/sendlist/register', [SendListController::class, 'store']);
Route::get('/sendlist', [SendListController::class, 'index']);
Route::get('/sendlist/{id}', [SendListController::class, 'fetchOneData']);
Route::post('/sendlist/{id}/update', [SendListController::class, 'update']);
