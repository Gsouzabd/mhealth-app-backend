<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';

    protected $fillable = [
        'dataHora',
        'id_funcionario',
        'id_especialidade',
        'unidadeId',
        'id_paciente',
    ];

    protected $casts = [
        'dataHora' => 'datetime',
        'id_funcionario' => 'integer',
        'id_especialidade' => 'integer',
        'unidadeId' => 'integer',
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'id_funcionario');
    }

    public function especialidade()
    {
        return $this->belongsTo(Especialidade::class, 'id_especialidade');
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class, 'unidadeId');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }
}