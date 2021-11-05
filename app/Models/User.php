<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $guarded = [''];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function buyCarts(){
        return $this->belongsToMany('App\Models\Models\Product');
    }

    public function roles(){
        return $this->belongsToMany('App\Models\Roles');
    }
    public function hasAnyRoles($roles){
        return null !==  $this->roles()->whereIn('name',$roles)->first();
    }
    public function hasRole($role){
        return null !==  $this->roles()->where('name',$role)->first();
    }
}
