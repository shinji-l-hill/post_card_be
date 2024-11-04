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

  public function destroy($id) 
  {
    $target = SendList::findOrFail($id);
    if(!$target) {
      ApiResponse::failed(
        config('constants.ERRORS.DELETE_FAILED'),
        null, 
        401
      );
    }
    try {
      $target->delete();
      $all_list = SendList::all();
      return ApiResponse::success(
        $all_list,
        config('constants.SUCCESS.DELETE_SUCCESS'),
      );
    } catch(ModelNotFoundException $e) {
      ApiResponse::failed(
        config('constants.ERRORS.DELETE_FAILED'),
        null, 
        401
      );
    }
  }
}