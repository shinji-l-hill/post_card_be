<?php

namespace App\Http\Controllers;

use App\Contracts\AdminAuthServiceInterface;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    protected $adminAuthService;

    public function __construct(AdminAuthServiceInterface $adminAuthService)
    {
        $this->adminAuthService = $adminAuthService;
    }


    public function login(LoginRequest $request) 
    {
        $credentials = $request->validated();
        return $this->adminAuthService->login($credentials);
    }
}
