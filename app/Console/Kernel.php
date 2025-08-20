<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('get:tias')
            ->everyTwoMinutes()
            ->withoutOverlapping()
            ->sendOutputTo(storage_path('logs/schedule.log'))
            ->appendOutputTo(storage_path('logs/schedule.log')); // opsional kalau mau kirim email
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
