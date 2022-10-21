<?php

namespace App\Listeners;

use App\Models\Traza_Funcionarios;
use App\Models\Traza_Resenna;
use App\Models\Traza_Roles;
use App\Models\Traza_User;

class TrazasListener
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
        $tabla = $event->getModule();
        $data = $event->getData();
        switch ($tabla) {
            case 'Traza_User':
                Traza_User::create($data);
                break;
            case 'Traza_Funcionarios':
                Traza_Funcionarios::create($data);
                break;
            case 'Traza_Resenna':
                Traza_Resenna::create($data);
                break;
            case 'Traza_Roles':
                Traza_Roles::Create($data);
                break;
            default:
                break;
        }
    }
}
