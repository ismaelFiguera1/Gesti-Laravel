<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuari extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuaris';

    protected $fillable = [
        'usuari',
        'correu',
        'rol',
        'password',
        'created_at'
    ];

    protected $hidden = [
        'password',
    ];
}
