<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *             required={"nome"},
 *          @OA\Property(property="nome", type="string", example="Nome do Convenio"),
 * *          @OA\Property(property="diasCarencia", type="integer", example=30),
 * *          @OA\Property(property="geraReceitas", type="boolean", example=true),
 * *          @OA\Property(property="numeroderegistro", type="string", example="xxxxxx"),
 * *          @OA\Property(property="codigonaoperadora", type="string", example=null),
 * *          @OA\Property(property="versaoxml", type="string", example=""),
 * *          @OA\Property(property="tabela", type="string", example="00"),
 * *          @OA\Property(property="maxSessoesTiss", type="integer", example=100),
 *         ),
 */
class Convenio extends Model
{
    use HasFactory;

    protected $table = 'convenios';

    protected $fillable = [
        "nome",
        "diasCarencia",
        "geraReceitas",
        "numeroderegistro",
        "codigonaoperadora",
        "versaoxml",
        "tabela",
        'maxSessoesTiss'
    ];

    public function pacientes()
    {
        return $this->belongsToMany(Paciente::class, 'convenios_pacientes');
    }

}
