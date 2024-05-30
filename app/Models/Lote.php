<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Lote",
 *     required={"id_convenio", "numero", "tipo", "data", "status", "valor_total"},
 *     @OA\Property(property="id_convenio", type="integer", example="1"),
 *     @OA\Property(property="numero", type="string", example="1"),
 *     @OA\Property(property="tipo", type="string", example="Consulta"),
 *     @OA\Property(property="data", type="string", format="date", example="2024-06-30"),
 *     @OA\Property(property="status", type="string", example="0"),
 *     @OA\Property(property="valor_total", type="number", format="decimal", example=100.00)
 * )
 */
class Lote extends Model
{
    use HasFactory;

    protected $table = 'lotes';

    protected $fillable = [
        'id_convenio',
        'numero',
        'tipo',
        'data',
        'status',
        'valor_total'
    ];

    public function convenio()
    {
        return $this->belongsTo(Convenio::class, 'id_convenio');
    }

    public function guias()
    {
        return $this->hasMany(Guia::class, "id_lote", "id");
    }
}
