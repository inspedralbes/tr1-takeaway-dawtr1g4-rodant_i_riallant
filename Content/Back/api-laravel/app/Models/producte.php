<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producte extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'descripcio',
        'preu',
        'categoria',
        'img',
        'estoc',
    ];
}
