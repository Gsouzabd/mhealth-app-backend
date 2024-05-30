<?php

namespace App\Models;

use App\Enums\MarcacaoTipoRecorrencia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Marcacao",
 *     type="object",
 *     required={"id_paciente", "id_funcionario", "id_especialidade", "convenio", "duracao", "horario", "data_inicial", "recorrencia", "marcadoPor", "unidade"},
 *     @OA\Property(property="id_paciente", type="integer", example=1),
 *     @OA\Property(property="id_funcionario", type="integer", example=2),
 *     @OA\Property(property="id_especialidade", type="integer", example=3),
 *     @OA\Property(property="convenio", type="integer", example=1),
 *     @OA\Property(property="duracao", type="integer", example=60),
 *     @OA\Property(property="horario", type="string", format="hour", example="14:00:00"),
 *     @OA\Property(property="data_inicial", type="string", format="date", example="2024-03-18"),
 *     @OA\Property(property="recorrencia", type="boolean", example=true),
 *     @OA\Property(property="tipoRecorrencia", type="string", enum={"s = semanal", "q = quinzenal", "m = mensal"}, example="semanal"),
 *     @OA\Property(property="vezesRecorrencia", type="integer", example=4),
 *     @OA\Property(property="marcadoPor", type="integer", example=1),
 *     @OA\Property(property="unidade", type="integer", example=1)
 * )
 */
class Marcacao extends Model
{
    use HasFactory;

    protected $table = "marcacoes";

    protected $fillable = [
        'id_paciente',
        'id_funcionario',
        'id_especialidade',
        'duracao', // (em minutos)
        'horario',
        'data_inicial',
        'recorrencia', // (true or false)
        'tipoRecorrencia', // Enum MarcacaoTipoRecorrencia [ Semanal , Quinzenal, Mensal ]
        'vezesRecorrencia',
        'marcadoPor', // (id funcionário)
        'convenio',
        'unidade', // (id unidade)
    ];

    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class, 'id_marcacao', 'id');
    }

}
