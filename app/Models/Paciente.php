<?php

namespace App\Models;

use App\Models\Usuario;
use App\Models\Responsavel;


/**
 * @OA\Schema(
 *      required={"nome", "cpf", "email", "data_nascimento", "sexo"},
*             @OA\Property(property="nome", type="string", example="José Silva"),
*             @OA\Property(property="cpf", type="string", example="000.000.000-00"),
*             @OA\Property(property="email", type="string", example="jose.silva@example.com", nullable=true),
*             @OA\Property(property="data_nascimento", type="string", format="date", example="2000-01-01"),
*             @OA\Property(property="sexo", type="string", example="M"),
*             @OA\Property(property="foto", type="string", example="arquivo.jpg", nullable=true),
*             @OA\Property(property="cep", type="string", example="00000-000", nullable=true),
*             @OA\Property(property="endereco", type="string", example="Rua Exemplo", nullable=true),
*             @OA\Property(property="numero", type="string", example="123", nullable=true),
*             @OA\Property(property="complemento", type="string", example="Apto 101", nullable=true),
*             @OA\Property(property="bairro", type="string", example="Centro", nullable=true),
*             @OA\Property(property="cidade", type="string", example="Cidade Exemplo", nullable=true),
*             @OA\Property(property="estado", type="string", example="Estado Exemplo", nullable=true),
*             @OA\Property(property="telefone", type="string", example="(00) 0000-0000", nullable=true),
*             @OA\Property(property="celular", type="string", example="(00) 90000-0000", nullable=true),
*             @OA\Property(property="pais", type="string", example="Brasil", nullable=true),
*             @OA\Property(property="cns", type="string", example="123 4567 8901 2345", nullable=true),
*             @OA\Property(property="diagnostico", type="string", example="Diagnóstico do paciente", nullable=true),
        *     @OA\Property(
        *         property="responsaveis",
        *         type="array",
        *         @OA\Items(ref="#/components/schemas/Responsavel"),
        *         example={
        *             {
        *                 "nome": "João da Silva",
        *                 "cpf": "123.456.789-11",
        *                 "email": "joao@example.com",
        *                 "data_nascimento": "2000-01-01",
        *                 "sexo": "M",
        *                 "foto": "arquivo.jpg",
        *                 "cep": "00000-000",
        *                 "endereco": "Rua Exemplo",
        *                 "numero": "123",
        *                 "complemento": "Apto 101",
        *                 "bairro": "Centro",
        *                 "cidade": "Cidade Exemplo",
        *                 "parentesco": "Pai",
        *                 "relacionamento": "Responsável",
        *                 "responsavelFinanceiro": true,
        *             },
        *             {
        *                 "nome": "Maria da Silva",
        *                 "cpf": "987.654.321-99",
        *                 "email": "maria@example.com",
        *                 "data_nascimento": "2002-03-15",
        *                 "sexo": "F",
        *                 "foto": "arquivo2.jpg",
        *                 "cep": "11111-111",
        *                 "endereco": "Rua Teste",
        *                 "numero": "456",
        *                 "complemento": "Casa",
        *                 "bairro": "Bairro Teste",
        *                 "cidade": "Cidade Teste",
        *                 "estado": "Estado Teste",
        *                 "parentesco": "Mãe",
        *                 "relacionamento": "Responsável",
        *                 "responsavelFinanceiro": false
        *             }
        *         }
        *     ),
     *             @OA\Property(property="nomePai", type="string", example="Nome do Pai", nullable=true),
     *             @OA\Property(property="nomeMãe", type="string", example="Nome da Mãe", nullable=true),
     *         ),
     * @OA\Property(
     *          property="convenios",
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
* )
*/
class Paciente extends Usuario
{
    protected $table = 'pacientes';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = array_merge($this->fillable, [
            'password',
            'cns',
            'diagnostico',
            'nomePai',
            'nomeMãe'
        ]);
    }

    public function convenios()
    {
        return $this->belongsToMany(Convenio::class, 'convenios_pacientes');
    }

    public function responsaveis()
    {
        return $this->hasMany(Responsavel::class);
    }

    public function responsavelFinanceiro()
    {
        return $this->hasMany(Responsavel::class)->where('responsavelFinanceiro', true);
    }
}
