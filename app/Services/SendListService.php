<?php

namespace App\Services;

use App\Contracts\SendListServiceInterface;
use App\Models\SendList;
use Illuminate\Support\Facades\Auth;

class SendListService implements SendListServiceInterface
{
  public function store($data) 
  {
    SendList::create($data);
    return $data;
  }
}