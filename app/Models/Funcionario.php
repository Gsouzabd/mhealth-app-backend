<?php

namespace App\Models;

use App\Models\Usuario;

/**
 * @OA\Schema(
 *      required={"nome", "cpf", "email", "password", "data_nascimento", "sexo", "administrativo", "especialista",},
 *      @OA\Property(property="nome", type="string", example="João da Silva"),
 *      @OA\Property(property="cpf", type="string", example="123.456.789-11"),
 *      @OA\Property(property="email", type="string", example="joao123@example.com"),
 *      @OA\Property(property="password", type="string", example="senha@123"),
 *      @OA\Property(property="data_nascimento", type="string", format="date", example="2000-01-01"),
 *      @OA\Property(property="sexo", type="string", example="M"),
 *      @OA\Property(property="foto", type="string", example="arquivo.jpg", nullable=true),
 *      @OA\Property(property="cep", type="string", example="00000-000", nullable=true),
 *      @OA\Property(property="endereco", type="string", example="Rua Exemplo", nullable=true),
 *      @OA\Property(property="numero", type="string", example="123", nullable=true),
 *      @OA\Property(property="complemento", type="string", example="Apto 101", nullable=true),
 *      @OA\Property(property="bairro", type="string", example="Centro", nullable=true),
 *      @OA\Property(property="cidade", type="string", example="Cidade Exemplo", nullable=true),
 *      @OA\Property(property="estado", type="string", example="Estado Exemplo", nullable=true),
 *      @OA\Property(property="telefone", type="string", example="(00) 0000-0000", nullable=true),
 *      @OA\Property(property="celular", type="string", example="(00) 90000-0000", nullable=true),
 *      @OA\Property(property="pais", type="string", example="Brasil", nullable=true),
 *      @OA\Property(property="data_criacao", type="string", format="date-time", example="2024-03-11 12:34:56"),
 *      @OA\Property(property="area", type="string", nullable=true),
 *      @OA\Property(property="administrativo", type="boolean", example=true),
 *      @OA\Property(property="especialista", type="boolean", example=false),
     * @OA\Property(
     *          property="especialidade",
     *      type="array",
     *          @OA\Items(
     *             type="integer",
     *            example="1",
     *         ),
     *               @OA\Items(
     *              type="integer",
     *             example="1",
     *          ),
     *         example={1, 2},
     *     ),
 *      @OA\Property(property="calendario_id", type="integer", nullable=true),
 *      @OA\Property(property="numConselho", type="string", nullable=true),
 *      @OA\Property(property="ufConselho", type="string", nullable=true),
 *      @OA\Property(property="conselho", type="integer", nullable=true),
 *      @OA\Property(property="dataUltimoAcesso", type="string", format="date-time", nullable=true),
 *      @OA\Property(property="system", type="string", nullable=true),
 *      @OA\Property(property="deviceToken", type="string", nullable=true),
 *      @OA\Property(property="data_contratacao", type="string", format="date", nullable=true),
 *      @OA\Property(property="created_at", type="string", format="date-time"),
 *      @OA\Property(property="updated_at", type="string", format="date-time"),
 * )
 */
class Funcionario extends Usuario
{
    protected $table = 'funcionarios';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = array_merge($this->fillable, [
            'password',
            'area',
            'administrativo',
            'especialista',
            'especialidade',
            'calendario_id',
            'numConselho',
            'ufConselho',
            'id_conselho',
            'dataUltimoAcesso',
            'system',
            'deviceToken',
            'img_logo',
            'profilepicture',
            'data_contratacao',
        ]);
    }

    public function conselho()
    {
        return $this->hasOne(Conselho::class, 'id', 'id_conselho');
    }

    public function especialidades()
    {
        return $this->belongsToMany(Especialidade::class, 'especialidades_funcionarios');
    }

    public function unidades()
    {
        return $this->belongsToMany(Unidade::class, 'funcionarios_unidades');
    }

}
