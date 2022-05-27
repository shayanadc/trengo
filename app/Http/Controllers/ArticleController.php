<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Services\Article\Concretes\ArticleStoreService;
use App\Services\Article\Contracts\ArticleListingContract;
use App\Services\Article\Contracts\ArticleStoreContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleListingContract $articleListingContract)
    {
        return response()->json(['articles' => $articleListingContract->getMany()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
