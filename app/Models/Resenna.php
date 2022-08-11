<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resenna extends Model
{
    use HasFactory;

    protected $table = 'resenna_detenido';

    //protected $fillable = ['url', 'rango_edad', 'person_id', 'rango_criminal_id', 'estatus_id', 'notificacion_interpol_id' , 'pais_solicitante_id'];

    //relacion de uno a unos con el modelo person
    public function resennado()
    {
        return $this->belongsto(Person::class, 'id_person');
    }

    //relacion de uno a muchos inverso
    public function estado_civil()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_estado_civil');
    }

    //relacion de uno a muchos inverso
    public function profesion()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_profesion');
    }
    
    //relacion de uno a muchos inverso
    public function motivo_resenna()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_motivo_resenna');
    }
    
    //relacion de uno a muchos inverso
    public function tez()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_tez');
    }   
    
    //relacion de uno a muchos inverso
    public function contextura()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_contextura');
    }  

    //relacion de uno a muchos inverso
    public function funcionario_aprehensor()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_funcionario_aprehensor');
    }  

    //relacion de uno a muchos inverso
    public function funcionario_resenna()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_funcionario_resenna');
    }  
}
