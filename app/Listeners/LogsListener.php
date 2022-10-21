<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class LogsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $data = $event->getData();
        $module = $event->getModule();
        Log::debug($module, $data);
    }
}
