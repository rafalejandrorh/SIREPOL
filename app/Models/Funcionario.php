<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';

    protected $fillable = ['credencial','id_jerarquia', 'id_estatus', 'telefono', 'id_person'];

    public function person()
    {
        return $this->belongsto(Person::class, 'id_person');
    }

    public function user()
    {
        return $this->hasone(User::class);
    }

    public function jerarquia()
    {
        return $this->belongsto(Jerarquia::class, 'id_jerarquia');
    }

    public function estatus()
    {
        return $this->belongsto(Estatus_Funcionario::class, 'id_estatus');
    }

    static function returnValidations(){

        return $validations=[
            'credencial'          => 'unique:credencial',
            'id_person' => 'unique:id_person'
        ];
        
    }

    static function  returnMessages(){

        return $messages=[
                'id_person.unique'      =>'Esta Persona ya se encuentra registrada como Funcionario',
                'credencial.unique'     =>'Otro Funcionario posee esta Credencial',

        ];
    } 
    
}
