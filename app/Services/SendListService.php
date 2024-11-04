<?php

namespace App\Services;

use App\Contracts\SendListServiceInterface;
use App\Http\Responses\ApiResponse;
use App\Models\SendList;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SendListService implements SendListServiceInterface
{
  public function store($data) 
  {
    SendList::create($data);
    return $data;
  }

  public function update($data, $id) 
  {
    try {

      $sendListData = SendList::findOrFail($id);
      $sendListData->name = $data->name;
      $sendListData->postcard_title = $data->postcard_title;
      $sendListData->postcard_sentence = $data->postcard_sentence;
      $sendListData->postcard_end = $data->postcard_end;
      $sendListData->save();
    } catch(ModelNotFoundException $e)  {
      ApiResponse::failed(
        config('constants.ERRORS.UPDATE_FAILED'),
        null, 
        401
      );
    }

    return ApiResponse::success(
      $sendListData,
      config('constants.SUCCESS.UPDATE_SUCCESS'),
    );
  }
}