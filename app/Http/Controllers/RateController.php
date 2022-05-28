<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRateRequest;
use App\Services\Rate\Contracts\StoreRateContract;
use Illuminate\Http\JsonResponse;

class RateController extends Controller
{
    public function store(StoreRateRequest $request, StoreRateContract $rateService): JsonResponse
    {
        return response()->json(['rate' => $rateService->store($request->validated() + ['ip' => $request->ip()])], 201);
    }
}
