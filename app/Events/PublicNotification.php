<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Alert;

class PublicNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $username;
    private $registro_involucrado;
    private $action;
    private $modulo;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username, $registro_involucrado, $modulo, $action)
    {
        $this->username = $username;
        $this->registro_involucrado = $registro_involucrado;
        $this->action = $action;
        $this->modulo = $modulo;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public-notification-channel');
    }

    public function broadcastAs()
    {
        return 'NotificationEvent';
    }

    public function broadcastWith()
    {
        switch ($this->modulo) {
            case 'Usuarios':
                $tipo_registro = 'Usuario';
                switch ($this->action) {
                    case 1:
                        $message = $this->username.' Registró al siguiente '.$tipo_registro.': '.$this->registro_involucrado;
                        break;
                    case 2:
                        $message = $this->username.' Actualizó al siguiente '.$tipo_registro.': '.$this->registro_involucrado;
                        break;
                    default:
                        break;
                }
                break;
            case 'Funcionarios':
                $tipo_registro = 'Funcionario';
                switch ($this->action) {
                    case 1:
                        $message = $this->username.' Registró al siguiente '.$tipo_registro.': '.$this->registro_involucrado;
                        break;
                    case 2:
                        $message = $this->username.' Actualizó al siguiente '.$tipo_registro.': '.$this->registro_involucrado;
                        break;
                    default:
                        break;
                }
                break;
            case 'Resennas':
                $tipo_registro = 'Reseña';
                switch ($this->action) {
                    case 1:
                        $message = $this->username.' Registró la siguiente '.$tipo_registro.' relacionada a: '.$this->registro_involucrado;
                        break;
                    case 2:
                        $message = $this->username.' Actualizó la siguiente '.$tipo_registro.' relacionada a: '.$this->registro_involucrado;
                        break;
                    case 3:
                        $message = $this->username.' aliminó la siguiente '.$tipo_registro.' relacionada a: '.$this->registro_involucrado;
                        break;
                    default:
                        break;
                }
                break;
            case 'Roles':
                $tipo_registro = 'Rol';
                switch ($this->action) {
                    case 1:
                        $message = $this->username.' Registró el siguiente '.$tipo_registro.': '.$this->registro_involucrado;
                        break;
                    case 2:
                        $message = $this->username.' Actualizó el siguiente '.$tipo_registro.': '.$this->registro_involucrado;
                        break;
                    case 3:
                        $message = $this->username.' Eliminó el siguiente '.$tipo_registro.': '.$this->registro_involucrado;
                        break;
                    default:
                        break;
                }
                break;
            case 'Trazas':
                $tipo_registro = 'Traza';
                switch ($this->action) {
                    case 4:
                        $message = $this->username.' Visualizó la '.$tipo_registro.' relacionada a: '.$this->registro_involucrado;
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
        return [
            'code' => '1',
            'message' => $message,
            'description' => 'Para Mayor Información, consulte las Trazas',
            'icon' => 'success'
        ];
    }
}
