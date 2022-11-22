<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function funcionario()
    {
        return $this->belongsto(Funcionario::class, 'id_funcionario');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify();//new ResetPassword($token)
    } 

    static function returnValidations(){

        return $validations=[
            'users'    => 'string|max:50|unique:users',
            'password' => 'required|min:6',
        ];
        
    }

    static function  returnMessages(){

        return $messages=[
            'users.unique' =>'Nombre de usuario en uso, ingrese otro por favor!',
            'password.min' =>'Tu contraseña debe ser de mínimo 6 caracteres.',
        ];
    } 
}
