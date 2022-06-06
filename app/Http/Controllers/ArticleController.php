<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\StoreRateRequest;
use App\Jobs\ViewArticle;
use App\Models\Article;
use App\Services\Article\Contracts\ArticleListingContract;
use App\Services\Article\Contracts\ArticleShowingContract;
use App\Services\Article\Contracts\ArticleStoreContract;
use App\Services\Review\Contracts\ReviewStoreContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(ArticleListingContract $articleListingContract): JsonResponse
    {
        return response()->json(['articles' => $articleListingContract->getMany()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return JsonResponse
     */
    public function store(StoreArticleRequest $request, ArticleStoreContract $articleStoreContract): JsonResponse
    {
        return response()->json(['article' => $articleStoreContract->store($request->validated())], 201);
    }


    /**
     * @param Article $article
     * @return JsonResponse
     */
    public function show(Article $article, Request $request, ArticleShowingContract $articleShowingContract) : JsonResponse
    {
        return response()->json(['article' => $articleShowingContract->getOne($article, $request)]);
    }

    public function storeReview(Article $article, StoreRateRequest $request, ReviewStoreContract $rateService): JsonResponse
    {
        return response()->json(['rate' => $rateService->store($article, $request->validated() + ['ip' => $request->ip()])], 201);
    }
}
