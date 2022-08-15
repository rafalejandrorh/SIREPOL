<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $dates = ['fecha_nacimiento'];
    protected $fillable = ['id_tipo_documentacion', 'letra_cedula', 'cedula', 
    'primer_nombre', 'segundo_nombre', 'primer_apellido' , 'segundo_apellido', 'id_genero', 'fecha_nacimiento', 
    'id_estado_nacimiento', 'id_municipio_nacimiento', 'id_pais_nacimiento'];

    public function person()
    {
        return $this->hasOne(Funcionario::class);
    }

    // relacion de uno a uno con la tabla funcionario
    public function resennado()
    {
        return $this->hasOne(Resenna::class, 'id_person');
    }

    public function documentacion()
    {
        return $this->belongsto(Documentacion::class,'id_tipo_documentacion');
    }

    public function genero()
    {
        return $this->belongsto(Genero::class,'id_genero');
    }

    public function estado_nacimiento()
    {
        return $this->belongsto(Geografia_Venezuela::class,'id_estado_nacimiento');
    }

    public function municipio_nacimiento()
    {
        return $this->belongsto(Geografia_Venezuela::class,'id_municipio_nacimiento');
    }

    public function pais_nacimiento()
    {
        return $this->belongsto(Geografia_Venezuela::class,'id_pais_nacimiento');
    }

    static function returnValidations(){

        return $validations=[

            'cedula'       => 'unique:persons'
            //'pasaporte'    => 'unique:persons'
        ];
        
    }

    static function  returnMessages(){
        return $messages=[

                'cedula.unique' =>'Cedula en uso, ingrese otro por favor!'
                //'pasaporte.unique'       =>'Pasaporte en uso, ingrese otro por favor!'

        ];
    } 

}
