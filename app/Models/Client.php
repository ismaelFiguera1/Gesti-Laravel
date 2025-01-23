<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'nom',
        'cognom',
        'correu',
        'telefon',
        'adreça',
        'poblacio',
        'codi_postal',
    ];
}
