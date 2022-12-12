<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = ['incoming_id_user','outgoing_id_user', 'message'];

    public function incomingUser()
    {
        return $this->belongsto(User::class, 'incoming_id_user');
    }

    public function outgoingUser()
    {
        return $this->belongsto(User::class, 'outgoing_id_user');
    }

}
