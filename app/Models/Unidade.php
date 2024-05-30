<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *          required={"nome", "endereco"},
 *          @OA\Property(property="nome", type="string", example="Unidade Ilha do leite"),
 *          @OA\Property(property="endereco", type="string", example="Av. Frei Matias Teves, 280 - Ilha do Leite, Recife - PE, 50070-465"),
 *         ),
 */
class Unidade extends Model
{
    use HasFactory;

    protected $table = 'unidades';

    protected $fillable = [
        'nome',
        'endereco'
    ];

    public function funcionarios()
    {
        return $this->belongsToMany(Funcionario::class, 'funcionarios_unidades');
    }
}
