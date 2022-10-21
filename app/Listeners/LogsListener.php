<?php

namespace App\Listeners;

use App\Models\Traza_Funcionarios;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
        // Traza_Funcionarios::create([
        //     'id_user' => $data['id_user'],
        //     'id_accion' => 5,
        //     'valores_modificados' => 'Prueba de Listener y Eventos' 
        // ]);
    }
}
