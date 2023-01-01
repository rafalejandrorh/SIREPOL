<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutas_Almacenamiento extends Model
{
    use HasFactory;

    protected $table = 'rutas_almacenamiento';
    protected $fillable = ['ruta', 'tipo_archivo', 'modulo', 'descripcion', 'nomenclatura'];

}
