<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Resenna extends Model
{
    use HasFactory;

    protected $table = 'resenna_detenido';
    protected $dates = ['fecha_resenna'];

    protected $fillable = ['url_foto', 'fecha_resenna', 'id_person', 'id_estado_civil', 'id_profesion', 'id_motivo_resenna', 
    'id_tez', 'id_contextura', 'id_funcionario_aprehensor', 'id_funcionario_resenna', 'direccion', 'observaciones'];

    public function resennado()
    {
        return $this->belongsto(Person::class, 'id_person');
    }

    public function estado_civil()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_estado_civil');
    }

    public function profesion()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_profesion');
    }
    
    public function motivo_resenna()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_motivo_resenna');
    }
    
    public function tez()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_tez');
    }   
    
    public function contextura()
    {
        return $this->belongsto(Caracteristicas_Resennado::class, 'id_contextura');
    }  

    public function funcionario_aprehensor()
    {
        return $this->belongsto(Funcionario::class, 'id_funcionario_aprehensor');
    }  

    public function funcionario_resenna()
    {
        return $this->belongsto(Funcionario::class, 'id_funcionario_resenna');
    }
    
    public function estatus_documentacion()
    {
        return $this->belongsto(tipo_documentacion::class, 'id');
    } 
    
    public function foto_resennado()
    {
        return Storage::url($this->url_foto);
    }

}
