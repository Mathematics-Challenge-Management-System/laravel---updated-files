<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table='admin';
    protected $primaryKey = 'admin_id';
    protected $guarded = ['id'];

    protected $fillable = [
      
        'Fname',
        'Lname',
        'Email',
        'Password',
     
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Password',
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

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function getAuthPassword()
    {
        return Hash::make($this->password, [
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);
    }
    public function isAdmin()
    {
        return true; // Or any logic to determine if the user is an admin
    }
  
}
