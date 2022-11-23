<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogoutHistorialEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id_user, $tipo_logout)
    {
        $this->id_user = $id_user;
        $this->tipo_logout = $tipo_logout;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getTipoLogout()
    {
        return $this->tipo_logout;
    }
}
