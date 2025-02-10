<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients'; // Nom de la taula

    // Camps assignables massivament
    protected $fillable = [
        'nom',
        'cognoms',
        'empresa',
        'tipus_client',
        'adreça',
        'telefon',
        'correu_electronic',
        'nif',
    ];
}
