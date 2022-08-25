<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geografia_Venezuela extends Model
{
    use HasFactory;

    protected $table = 'geografia_venezuela';

    protected $fillable = ['id', 'valor', 'id_padre', 'id_hijo'];

    public function nomencladores(){
        return $this->hasMany(Geografia_Venezuela::class, 'id_hijo', 'id');
    }

    public function nomenclador(){
        return $this->belongsTo(Geografia_Venezuela::class, 'id_hijo', 'id');
    }
}
