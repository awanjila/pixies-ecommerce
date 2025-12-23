<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;

class Client extends AuthenticatableUser implements Authenticatable
{
    use HasFactory, Notifiable;

    use HasFactory;

    protected $fillable = [
        'name',     // Name of the client
        'email',    // Email address of the client
        'password', // Hashed password of the client
        // Any other fields you may need
    ];

}
