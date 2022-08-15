<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user' => 'required|users|unique:users',
            'credencial' => 'credencial|unique:credencial',
            'cedula' => 'required|cedula|unique:cedula',
            'primer_nombre' => 'required',
            'segundo_nombre' => 'required',
            'primer_apellido' => 'required',
            'segundo_apellido' => 'required',
            'genero' => 'required',
            'fecha_nacimiento' => 'required|date_format:d/m/Y',
            'estado_nacimiento' => 'required',
            'id_jerarquia' => 'required',
            'estatus_funcionario' => 'required',
            'roles' => 'required'
        ];
    }
}
