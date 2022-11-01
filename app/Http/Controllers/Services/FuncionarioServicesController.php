<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\DataServicesController;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class FuncionarioServicesController extends Controller
{
    public function __construct(DataServicesController $dataservices, User $user)
    {
        $this->dataservices = $dataservices;
        $this->user = $user;
    }

    public function SearchFuncionario($tipo, $valor)
    {
        $id_user = 2;
        $ip = '192.168.0.101';
        $mac = '00:00:00:00';
        $metodo = ConsultaFuncionario;
        $parametros_servicio = array(
            'tipo' => $tipo,
            'valor' => $valor,
            'id_user' => $id_user
        );
        $request = $tipo.': '.$valor;
        $token = $this->dataservices->validarToken();
        // if($this->user->can(ConsultarFuncionarios))
        // {
            if(isset($tipo) && isset($valor) && isset($id_user))
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
