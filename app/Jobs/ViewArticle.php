<?php

namespace App\Jobs;

use App\Models\Article;
use App\Services\RealTimeView\Contracts\ViewProcessorContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ViewArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 25;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     *
     * @var int
     */
    public $maxExceptions = 3;

    protected Article $article;

    protected string $ip;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Article $article, string $ip)
    {
        $this->article = $article->withoutRelations();
        $this->ip = $ip;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ViewProcessorContract $viewProcessor)
    {
        $viewProcessor->store($this->article, $this->ip);
    }
}
