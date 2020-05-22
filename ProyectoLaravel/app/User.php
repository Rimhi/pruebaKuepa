<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','surname','phone','calls','role','program_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function program(){
        return $this->belongsTo(Program::class);
    }
    public function scopeName($query, $name){
        if($name){
            return $query->where('name','LIKE',"%$name%");
        }
        
    }
    public function scopeEmail($query, $name){
        if($name){
            return $query->where('email','LIKE',"%$name%");
        }

    }
    public function scopeSurname($query, $name){
        if($name){
            return $query->where('surname','LIKE',"%$name%");
        }

    }
    public function scopePhone($query, $name){
        if($name){
            return $query->where('phone','LIKE',"%$name%");
        }

    }

}
