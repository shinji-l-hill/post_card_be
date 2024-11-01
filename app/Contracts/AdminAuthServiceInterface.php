<?php

namespace App\Contracts;

interface AdminAuthServiceInterface
{
  public function login($credencial);
}