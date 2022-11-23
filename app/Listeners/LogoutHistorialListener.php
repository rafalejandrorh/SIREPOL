<?php

namespace App\Listeners;

use App\Models\Historial_Sesion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogoutHistorialListener
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
        $id_user = $event->getIdUser();
        $tipo_logout = $event->getTipoLogout();

        $sesion = Historial_Sesion::find($id_user, ['id']);
        $sesion->logout = now();
        $sesion->tipo_logout = $tipo_logout;
        $sesion->save();
    }
}
