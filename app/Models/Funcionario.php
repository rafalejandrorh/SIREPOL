<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';

    //protected $fillable = ['credencial','rango_id', 'organismo_id', 'despacho_id', 'telefono', 'person_id', 'estatus_laboral_id'];

    // relacion de uno a uno con la tabla funcionario(inversa)
    public function person()
    {
        return $this->belongsto(Person::class, 'id_person');
    }

    public function user()
    {
        return $this->hasone(User::class);
    }

    //relacion de uno a muchos
    public function jerarquia()
    {
        return $this->belongsto(Jerarquia::class, 'id_jerarquia');
    }

    //relacion de uno a muchos
    public function estatus()
    {
        return $this->belongsto(Estatus_Funcionario::class, 'id_estatus');
    }
    
}
