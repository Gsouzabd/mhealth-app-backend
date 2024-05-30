<?php

namespace App\Models;

/**
 * @OA\Schema(
*             required={"nome", "cpf", "email", "password", "data_nascimento", "sexo"},
*                  @OA\Property(property="nome", type="string", example="João da Silva"),
*                  @OA\Property(property="cpf", type="string", example="123.456.789-11"),
*                  @OA\Property(property="email", type="string", example="joao123@example.com"),
*                  @OA\Property(property="password", type="string", example="senha@123"),
*                  @OA\Property(property="data_nascimento", type="string", format="date", example="2000-01-01"),
*                  @OA\Property(property="sexo", type="string", example="M"),
*                  @OA\Property(property="foto", type="string", example="arquivo.jpg", nullable=true),
*                  @OA\Property(property="cep", type="string", example="00000-000", nullable=true),
*                  @OA\Property(property="endereco", type="string", example="Rua Exemplo", nullable=true),
*                  @OA\Property(property="numero", type="string", example="123", nullable=true),
*                  @OA\Property(property="complemento", type="string", example="Apto 101", nullable=true),
*                  @OA\Property(property="bairro", type="string", example="Centro", nullable=true),
*                  @OA\Property(property="cidade", type="string", example="Cidade Exemplo", nullable=true),
*                  @OA\Property(property="estado", type="string", example="Estado Exemplo", nullable=true),
 *                  @OA\Property(property="telefone", type="string", example="(00) 0000-0000", nullable=true),
 *                  @OA\Property(property="celular", type="string", example="(00) 90000-0000", nullable=true),
 *                  @OA\Property(property="pais", type="string", example="Brasil", nullable=true),
*         ),
*/
class Administrador extends Usuario
{
    protected $table = 'administradores';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = array_merge($this->fillable, [
            'password'
        ]);
    }

}
