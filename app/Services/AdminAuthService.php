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
    $user = Auth::guard('admin')->getProvider()->retrieveByCredentials($credentials);
    $token = Auth::guard('admin')->attempt($credentials);


    $inputPassword = $credentials['password'];

    if (!$user || !Hash::check($inputPassword, $user->password)) {
      return ApiResponse::failed(
        config('constants.ERRORS.LOGIN_FAILED'),
        null,
        401);
    }

    return $this->respondWithToken($token);
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
                'name'=> $user->name,
                'email' => $user->email,
            ]
        ],
        config('constants.SUCCESS.LOGIN_SUCCESS')
      );
    }
}