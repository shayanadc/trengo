<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRateRequest;
use App\Services\Review\Contracts\ReviewStoreContract;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    public function store(StoreRateRequest $request, ReviewStoreContract $rateService): JsonResponse
    {
        return response()->json(['rate' => $rateService->store($request->validated() + ['ip' => $request->ip()])], 201);
    }
}
