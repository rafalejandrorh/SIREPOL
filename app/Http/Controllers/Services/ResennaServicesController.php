<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ResennaServicesController extends Controller
{
    public function __construct(DataServicesController $dataservices, User $user)
    {
        $this->dataservices = $dataservices;
        $this->user = $user;
    }

    public function SearchResennado($cedula)
    {
        $id_user = 2;
        $ip = '192.168.0.101';
        $mac = '00:00:00:00';
        $metodo = ConsultaResennado;
        $parametros_servicio = array(
            'cedula' => $cedula,
            'id_user' => $id_user
        );
        $request ='Cedula: '.$cedula;
        $token = $this->dataservices->validarToken();
        // if($this->user->tokenCan(ConsultarResennados))
        // {
            if(isset($cedula))
            {
                $response = $this->dataservices->validarRequest($parametros_servicio, $metodo, $token);
            }else{
                $response = $this->dataservices->errorInvalidRequest();
            }
        // }else{
        //     $response = $this->dataservices->errorCodeUnauthorizedService();
        // }
        $this->dataservices->GuardarTrazas($ip, $mac, $id_user, $metodo, $response, $request, $token['data']);

        return response()->json($response);
    }
}
