<?php

namespace App\Http\Controllers;

use App\Contracts\SendListServiceInterface;
use App\Http\Requests\SendListRequest;
use App\Http\Responses\ApiResponse;
use App\Models\SendList;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SendListController extends Controller
{
    protected $sendListService;

    public function __construct(SendListServiceInterface $sendListService)
    {
        $this->sendListService = $sendListService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sendlist = SendList::all();
        try {
            return ApiResponse::success(
                $sendlist,
                config('constants.SUCCESS.FETCH_SUCCESS'),
            );
        } catch (\Exception $e) {
            // エラーレスポンスを返す
            Log::error($e);
            return ApiResponse::failed(
                config('constants.ERRORS.FETCH_FAILED'),
                null, 
                500
            );
        }   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SendListRequest $request)
    {
        try {
            $validatedData = $request->validated();
            return ApiResponse::success([
                $this->sendListService->store($validatedData),
                config('constants.SUCCESS.STORE_SUCCESS'),
            ]);
        } catch (\Exception $e) {
            // エラーレスポンスを返す
            Log::error($e);
            return ApiResponse::failed(
                config('constants.ERRORS.STORE_FAILED'),
                null, 
                500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->sendListService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->sendListService->destroy($id);
    }

    public function fetchOneData(string $id)
    {
        try {
            $data = SendList::where('uuid', $id)->firstOrFail();
            return ApiResponse::success(
                $data,
            );
        } catch (ModelNotFoundException $e) {
            return ApiResponse::failed(
                config('constants.ERRORS.FETCH_FAILED'),
                null, 
                404
            );
        }
    }
}
