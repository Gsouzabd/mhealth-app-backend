<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conselho extends Model
{
    use HasFactory;

    protected $table = 'conselhos';

    protected $fillable = [
        'nome',
        'sigla',
        'codigo_termo'
    ];

}
