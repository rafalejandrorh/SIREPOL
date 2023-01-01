<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traza_API extends Model
{
    use HasFactory;

    protected $table = 'traza_api';

    public function user()
    {
        return $this->belongsto(User::class, 'id_user');
    }
}
