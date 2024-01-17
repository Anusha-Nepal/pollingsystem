<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Verifyemail extends Model
{
    use HasFactory,Notifiable;
    protected $table = "verify_emails";

   

    protected $fillable = [
        'token','user_id',
        

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
