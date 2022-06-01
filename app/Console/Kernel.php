<?php

namespace App\Console;

use App\Services\RealTimeView\Concretes\DailyViewSnapshot;
use App\Services\Review\Concretes\ArticleReviewCollectorService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function (){
            DailyViewSnapshot::perform();
        })->daily();

        $schedule->call(function (){
            ArticleReviewCollectorService::perform();
        })->daily();

        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
