<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password','email_verified_at','verification_token',
    ];
    protected $with= "verifyemail";
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function polls()
{
    return $this->hasMany(Poll::class);
}
// public function roles(){
//     return $this->hasmany(Roles::class,'role_id','user_id');
// }
public function roles()
{
    return $this->belongsToMany(Roles::class, '_role_user', 'user_id', 'roles_id');
}
public function votes()
    {
        return $this->hasMany(Vote::class);
    }
public function hasPermission($usercreate){
  return $this->haspermissions();
}
public function hasRole($role)
{
     return $this->roles->contains('name', $role);
}
public function choices()
{
    return $this->hasMany(Choice::class); 
}

public function verifyemail()
{
    return $this->hasOne(Verifyemail::class);
}

}
