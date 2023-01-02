<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organismos_Seguridad extends Model
{
    use HasFactory;

    protected $table = 'nomenclador.organismos_seguridad';
    protected $fillable = ['nombre', 'abreviatura', 'id_padre'];

    public function nombrePadre()
    {
        return $this->belongsto(Organismos_Seguridad::class,'id_padre');
    }
}
