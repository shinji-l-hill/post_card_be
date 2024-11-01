<?php

use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
  return response()->json(['message' => 'Hello, World!']);
});
Route::post('/admin/login', [AdminAuthController::class, 'login']);
