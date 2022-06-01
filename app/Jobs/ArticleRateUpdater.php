<?php

namespace App\Jobs;

use App\Services\Review\Concretes\ArticleRateSyncService;
use App\Services\Review\Contracts\ArticleRateCollectorContract;
use App\Services\View\Contracts\ViewAggregatorStoreContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ArticleRateUpdater implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     *
     * @var int
     */
    public $maxExceptions = 3;

    private array $review;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $review)
    {
        $this->review = $review;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ArticleRateSyncService $rateSyncContract)
    {
        $rateSyncContract->sync($this->review);
    }
}
