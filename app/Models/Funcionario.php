<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';

    protected $fillable = ['credencial','id_jerarquia', 'id_estatus', 'telefono', 'id_person', 'id_organismo'];

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

    public function organismo()
    {
        return $this->belongsto(Organismos_Seguridad::class, 'id_organismo');
    }

    static function returnValidations(){

        return $validations=[
            'credencial'          => 'unique:funcionarios',
        ];
        
    }

    static function  returnMessages(){

        return $messages=[
                'credencial.unique'     => 'Otro Funcionario posee esta Credencial',
        ];
    } 
    
}
