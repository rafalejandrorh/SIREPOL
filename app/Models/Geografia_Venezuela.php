<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geografia_Venezuela extends Model
{
    use HasFactory;

    protected $table = 'geografia_venezuela';

    protected $fillable = ['id', 'valor', 'id_padre', 'id_hijo'];
}
