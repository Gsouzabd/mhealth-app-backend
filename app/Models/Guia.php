<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Guia",
 *     type="object",
 *      required={"lote_numero", "id_convenio", "id_paciente", "id_procedimento", "status", "data", "quantidade", "valor", "id_contratado_executante", "id_profissional_executante"},
 *     @OA\Property(property="lote_numero", type="integer", example=1),
 *     @OA\Property(property="id_convenio", type="integer", example=1),
 *     @OA\Property(property="id_paciente", type="integer", example=1),
 *     @OA\Property(property="id_procedimento", type="intenger", example="14"),
 *     @OA\Property(property="status", type="string", example=0),
 *     @OA\Property(property="num_guia_prestador", type="string", example="GP001"),
 *     @OA\Property(property="num_guia_operadora", type="string", example="GO001"),
 *     @OA\Property(property="data", type="string", format="date", example="2024-03-29"),
 *     @OA\Property(property="quantidade", type="integer", example=1),
 *     @OA\Property(property="valor", type="number", format="float", example=100.00),
 *     @OA\Property(property="tabela", type="string", example="00"),
 *     @OA\Property(property="id_contratado_executante", type="integer", example=1),
 *     @OA\Property(property="codigo_operadora_contratado", type="string", example="COD001"),
 *     @OA\Property(property="cnpj_contratado", type="string", example="12345678901234"),
 *     @OA\Property(property="cnes_contratado", type="string", example="CNES001"),
 *     @OA\Property(property="id_profissional_executante", type="integer", example=2),
 *     @OA\Property(property="codigo_operadora_profissional", type="string", example="COD002"),
 *     @OA\Property(property="id_conselho", type="string", example="1"),
 *     @OA\Property(property="numero_conselho_profissional", type="string", example="08"),
 *     @OA\Property(property="uf_conselho_profissional", type="string", example=26),
 *     @OA\Property(property="cbo_s", type="string", example="251510"),
 *     @OA\Property(property="tipo_consulta", type="string", example="4"),
 *     @OA\Property(property="indicador_acidente", type="string", example="9"),
 *     @OA\Property(property="cobertura_especial", type="string", example="02"),
 *     @OA\Property(property="atendimento_regime", type="string", example="01"),
 *     @OA\Property(property="observacao", type="string", example="Observações adicionais")
 * )
 */
class Guia extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_lote',
        'lote_numero',
        'id_convenio',
        'id_paciente',
        'id_procedimento',
        'status',
        'num_guia_prestador',
        'num_guia_operadora',
        'data',
        'quantidade',
        'valor',
        'tabela',
        'id_contratado_executante',
        'codigo_operadora_contratado',
        'cnpj_contratado',
        'cnes_contratado',
        'id_profissional_executante',
        'codigo_operadora_profissional',
        'id_conselho',
        'numero_conselho_profissional',
        'uf_conselho_profissional',
        'cbo_s',
        'tipo_consulta',
        'indicador_acidente',
        'cobertura_especial',
        'atendimento_regime',
        'observacao',
    ];

    public function lote()
    {
        return $this->belongsTo(Lote::class, 'id_lote');
    }
    public function convenio()
    {
        return $this->hasOne(Convenio::class, 'id', 'id_convenio');
    }

    public function beneficiario()
    {
        return $this->hasOne(Paciente::class, 'id', 'id_paciente');
    }

    public function contratado()
    {
        return $this->hasOne(Estabelecimento::class, 'id', 'id_contratado_executante');
    }

    public function profissional()
    {
        return $this->hasOne(Funcionario::class, 'id', 'id_profissional_executante');
    }

    public function procedimento()
    {
        return $this->hasOne(Procedimento::class, 'id', 'id_procedimento');

    }

}
