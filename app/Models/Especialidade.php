<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 * *             required={"nome", "cbos"},
 * * *          @OA\Property(property="nome", type="string", example="Psicologia"),
 * * *          @OA\Property(property="descricao", type="string", example="Descrição da especialidade"),
 * * *          @OA\Property(property="cbos", type="string", example="2515-10"),
 * *      ),
 */
class Especialidade extends Model
{
    use HasFactory;

    protected $table = 'especialidades';

    protected $fillable = [
        'nome',
        'descricao',
        'cbos_codigo',
        'conselho',
    ];

    public function especialistas()
    {
        return $this->belongsToMany(Funcionario::class, 'especialidades_funcionarios');
    }

    public function conselho()
    {
        return $this->belongsTo(Conselho::class, 'conselho_id');
    }

}
