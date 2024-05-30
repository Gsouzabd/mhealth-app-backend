<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estabelecimento extends Model
{
    use HasFactory;

    protected $table = 'estabelecimentos';

    protected $fillable = [
        'nome',
        'nome_empresarial',
        'endereco',
        'telefone',
        'cnes',
        'natureza_juridica',
        'gestao',
        'subtipo',
        'cnpj',
        'dependencia',
    ];
}
