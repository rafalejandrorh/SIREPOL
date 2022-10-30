<?php

namespace App\Console;

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
        // $schedule->command('inspire')->hourly();
        $schedule->command('sanctum:prune-expired --hours=24')->daily();

        // Ejecutar Jobs y Colas cada cierto tiempo
        //use App\Jobs\Heartbeat;
            // Dispatch the job to the "heartbeats" queue on the "sqs" connection...
        //$schedule->job(new Heartbeat, 'heartbeats', 'sqs')->everyFiveMinutes();

        // Ejecutar comandos en el Sistema Operativo
        $schedule->exec('node /home/forge/script.js')->daily();
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
