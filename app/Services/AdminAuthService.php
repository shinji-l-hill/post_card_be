<?php

namespace App\Services;

use App\Contracts\AdminAuthServiceInterface;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminAuthService implements AdminAuthServiceInterface
{
  public function login($credentials) 
  {
    try {
      $token = Auth::guard('admin')->attempt($credentials); // 認証＆トークン生成

      // 認証失敗時のレスポンス
      if (!$token) {
          return ApiResponse::failed(
              config('constants.ERRORS.LOGIN_FAILED'),
              null,
              401
          );
      }

      // 認証成功時のみユーザー情報を取得
      return $this->respondWithToken($token);
  } catch (\Exception $e) {
      // 例外が発生した場合のエラーレスポンス
      return ApiResponse::failed(
          config('constants.ERRORS.LOGIN_FAILED'),
          null,
          500
      );
  }
  }

  protected function respondWithToken($token)
  {
    // 認証されたユーザーの情報を取得
    $user = Auth::guard('admin')->user();

    // レスポンスにユーザー情報を含める
    return ApiResponse::success([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => Auth::guard('admin')->factory()->getTTL() * 60,
      'user' => [
          'id' => $user->id,
          'name' => $user->name,
          'email' => $user->email,
      ]
    ], config('constants.SUCCESS.LOGIN_SUCCESS'));
  }
}