<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;

    protected $table = 'atendimentos';

    protected $fillable = [
        'id_marcacao',
        'data'       ,
        'status'     , // ( m: marcado, ee: em espera, ea: em andamento, r: realizado, f: falta , d: desmarcado)
        'recorrente' , // boolean
        'horario',
        'duracao'
    ];

    public function marcacao()
    {
        return $this->belongsTo(Marcacao::class, 'id_marcacao');
    }
}
