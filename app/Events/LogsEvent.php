<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($module, $id_user, $action_user)
    {
        $this->id_user = $id_user;
        $this->action_user = $action_user;
        $this->module = $module;
    }

    public function getData()
    {
        return array(
            'id_user' => $this->id_user,
            'action_user' => $this->action_user 
        );
    }

    public function getModule()
    {
        return $this->module;
    }

}
