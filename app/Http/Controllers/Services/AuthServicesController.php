<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthServicesController extends Controller
{
    public function __construct(DataServicesController $dataservices, User $user)
    {
        $this->dataservices = $dataservices;
        $this->user = $user;
    }

    public function login($user, $password)
    {
        $validar_user = $this->user::where('users', $user)->exists();
        if($validar_user == true)
        {
            $user = $this->user::where('users', $user)->first();
            $validacion_password = Hash::check($password, $user->password);
            if($validacion_password == true)
            {
                $data_user = $user->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
                ->select('persons.primer_nombre', 'persons.primer_apellido', 'jerarquia.valor AS jerarquia')
                ->first();

                $date_now = date('d-m-Y H:i:s');
                $date_expire_token = date('d-m-Y H:i:s', strtotime($date_now."+ 12 hour"));
                $token = null;
                $token = $user->createToken('authTokenApp', ['*'], $date_expire_token)->plainTextToken;
                $user->withAccessToken($token);
                
                $data = array(
                    'Message' => 'Inicio de Sesión Exitoso',
                    'User_id' => $user['id'],
                    'Name_Funcionario' => $data_user['jerarquia'].' '.$data_user['primer_nombre'].' '.$data_user['primer_apellido'],
                    'Token_Bearer' => $token
                );
                $response = $this->dataservices->okCodeAuth($data);
            }else{
                $data = array('Message' => 'Contraseña Incorrecta');
                $response = $this->dataservices->errorCodeAuth($data);
            }
        }else{
            $data = array('Message' => 'Usuario Incorrecto o No Registrado');
            $response = $this->dataservices->errorCodeAuth($data);
        }
        return response()->json($response, $response['Code']);
    }

    public function logout()
    {
        $token = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);
        PersonalAccessToken::findToken($token[1])->delete();
        $data = array('Message' => 'Sesión Finalizada Exitosamente');
        $response = $this->dataservices->okCodeAuth($data);
        return response()->json($response, $response['Code']);
    }

    // Determinar si el Token tiene la capacidad determinada
    // if ($user->tokenCan('server:update')) {
    //     //
    // }

    // El middleware se puede asignar a una ruta para verificar que el token de la solicitud tiene las capacidades
    // Route::get('/orders', function () {
    //     // Token has both "check-status" and "place-orders" abilities...
    // })->middleware(['auth:sanctum', 'abilities:check-status,place-orders']);

    // Route::get('/orders', function () {
    //     // Token has the "check-status" or "place-orders" ability...
    // })->middleware(['auth:sanctum', 'ability:check-status,place-orders']);
}
