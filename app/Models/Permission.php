<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['route_name','common_name','group_name'];


    public function roles(){
        return $this->belongsToMany(Permission::class,PermissionRole::class,'permission_id','role_id');
    }

    
    
}
