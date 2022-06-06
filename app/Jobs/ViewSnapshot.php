<?php

namespace App\Jobs;

use App\Services\View\Contracts\ViewSnapshotStoreContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ViewSnapshot implements ShouldQueue
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

    protected array $views;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $views)
    {
        $this->views = $views;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ViewSnapshotStoreContract $dailyViewSnapshot)
    {
        $dailyViewSnapshot->insertMany($this->views);
    }
}
