<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Services\DataServices;
use App\Models\Token_API;
use App\Models\Traza_API;

class DataServicesController extends Controller
{
    
    public function __construct(DataServices $servicio, Token_API $token, Traza_API $traza_api)
    {
        $this->servicio = $servicio;
        $this->tokens = $token;
        $this->trazas = $traza_api;
    }

    public function validarToken() 
    {
        if(isset($_SERVER['HTTP_AUTHORIZATION']))
        {
            $ex = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);
            $bearer = $ex[0];
            if(isset($ex[1]))
            {
                $token = $ex[1];
            }else{
                $token = null;
            };  
            if(isset($bearer) && $bearer == 'Bearer')
            {
                $response = $this->okCodeToken();
            }else{
                $response = $this->errorCodeNoTokenBearer();
            }
        }else{
            $response = $this->errorCodeNoToken();
        };
        
        $result = array(
            'response' => $response,
            'data' => $token
        );
        return $result;
    }

    public function validarRequest($parametros, $metodo, $token)
    {
        if($token['response']['Code'] == 202){
            if($parametros['id_user'] != null)
            {
                $dataservices = $this->servicio;
                $dataservices->setMetodo($metodo);
                $dataservices->setParametros($parametros);
                $datos = $dataservices->Servicios();
                if(!empty($datos)){
                    $response = $this->okCodeService($datos);
                }else{
                    $response = $this->errorCodeService();
                }
            }else{
                $response = $this->errorCodeRequest($parametros);
            } 
        }else{
            $response = $token['response'];
        }
        return $response;   
    }

    public function GuardarTrazas($ip, $mac, $id_user, $metodo, $response, $request, $token)
    {
        if(is_array($metodo) == true)
        {
            $metodo = print_r($metodo, true);
        }

        if(is_array($request) == true)
        {
            $request = print_r($request, true);
        }

        $this->trazas->ip = $ip;
        $this->trazas->mac = $mac;
        $this->trazas->id_user = $id_user;
        $this->trazas->fecha_request = date('Y-m-d H:i:s');
        $this->trazas->action = $metodo;
        $this->trazas->response = json_encode($response, true);
        $this->trazas->request = $request;
        $this->trazas->token = $token;
        $this->trazas->save();
    }

    public function okCodeAuth($data)
    {
        $response = [
            'Code' => "".OK_CODE_AUTH."",
            'Status' => OK_DESCRIPTION_AUTH,
            'Data' => $data
        ];
        return $response;
    }

    public function errorCodeAuth($data)
    {
        $response = [
            'Code' => "".ERROR_CODE_AUTH."",
            'Status' => ERROR_DESCRIPTION_AUTH,
            'Data' => $data
        ];
        return $response;
    }

    private function okCodeService($data)
    {
        $response = [
            'Code' => "".OK_CODE_SERVICE."",
            'Status' => OK_DESCRIPTION_SERVICE,
            'Data' => $data
        ];
        return $response;
    }

    private function errorCodeService()
    {
        $response = [
            'Code' => "".ERROR_CODE_SERVICE."",
            'Status' => ERROR_DESCRIPTION_SERVICE,
            'Description' => 'El Servicio  que intenta consultar no existe o no se encuentra disponible',
        ];
        return $response;
    }

    private function errorCodeRequest($data)
    {
        $response = [
            'Code' => "".ERROR_CODE_REQUEST."",
            'Status' => ERROR_DESCRIPTION_REQUEST,
            'Request' => $data
        ];
        return $response;
    }

    public function errorCodeUnauthorizedService()
    {
        $response = [
            'Code' => "".ERROR_CODE_UNAUTHORIZED_SERVICE."",
            'Status' => ERROR_DESCRIPTION_UNAUTHORIZED_SERVICE,
            'Message' => 'No posee Autorizacion para consultar este servicio',
        ];
        return $response;
    }

    private function okCodeToken()
    {
        $response = [
            'Code' => "".OK_CODE_TOKEN."",
            'Status' => OK_DESCRIPTION_TOKEN,
        ];
        return $response;
    }

    private function errorCodeToken()
    {
        $response = [
            'Code' => "".ERROR_CODE_TOKEN."",
            'Status' => ERROR_DESCRIPTION_TOKEN,
        ];
        return $response;
    }

    private function errorCodeNoTokenBearer()
    {
        $response = [
            'Code' => "".ERROR_CODE_NO_TOKEN_BEARER."",
            'Status' => ERROR_DESCRIPTION_NO_TOKEN_BEARER,
        ];
        return $response;
    }

    private function errorCodeTokenExpire()
    {
        $response = [
            'Code' => "".ERROR_CODE_TOKEN_EXPIRE."",
            'Status' => ERROR_DESCRIPTION_TOKEN_EXPIRE,
        ];
        return $response;
    }

    private function errorCodeNoToken()
    {
        $response = [
            'Code' => "".ERROR_CODE_NO_TOKEN."",
            'Status' => ERROR_DESCRIPTION_NO_TOKEN,
        ];
        return $response;
    }

    public function errorInvalidRequest()
    {
        $response = [
            'Code' => "".ERROR_CODE_INVALID_REQUEST."",
            'Status' => ERROR_DESCRIPTION_INVALID_REQUEST,
        ];
        return $response;
    }

    public function errorUnauthorizedAction()
    {
        $response = [
            'Code' => "".ERROR_UNAUTHORIZED_ACTION."",
            'Status' => ERROR_DESCRIPTION_UNAUTHORIZED_ACTION,
            'Description' => 'La Accion que pretende realizar no se encuentra permitida en este servicio. El incidente sera reportado.'
        ];
        return $response;
    }

    private function errorCodeInactiveToken()
    {
        $response = [
            'Code' => "".ERROR_CODE_INACTIVE_TOKEN."",
            'Status' => ERROR_DESCRIPTION_INACTIVE_TOKEN,
        ];
        return $response;  
    }

    private function errorCodeInactiveService($data)
    {
        $response = [
            'Code' => "".ERROR_CODE_INACTIVE_SERVICE."",
            'Status' => ERROR_DESCRIPTION_INACTIVE_SERVICE,
            'Description' => 'El Servicio que intenta Consultar se encuentra Inactivo',
            'Request' => $data
        ];
        return $response;
    }

    private function okWelcome()
    {
        $response = [
            'Code' => "".OK_CODE_SERVICE."",
            'Status' => OK_DESCRIPTION_SERVICE,
            'Description' => 'Revisa la Documentacion para utilizar el Servicio.'
        ];
        return $response;
    }

}
