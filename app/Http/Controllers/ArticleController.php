<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Services\Article\Contracts\ArticleListingContract;
use App\Services\Article\Contracts\ArticleStoreContract;
use Illuminate\Http\JsonResponse;

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
    public function show(Article $article) : JsonResponse
    {
        return response()->json(['article' => $article]);
    }
}
