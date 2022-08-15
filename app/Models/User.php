<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    static function returnValidations(){

        return $validations=[

            'users'     => 'string|max:255|unique:users',
        ];
        
    }

    static function  returnMessages(){
        return $messages=[

                //'name.required'      =>'El Nombre es obligatorio.',
                //'email.required'     =>'El Email  es obligatorio.',
                'users.unique'        =>'Nombre de usuario en uso, ingrese otro por favor!',
                //'password.required'  =>'El password es obligatorio.',

        ];
} 
}
