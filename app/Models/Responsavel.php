<?php

namespace App\Models;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      required={"nome", "cpf", "email", "data_nascimento", "sexo", "paciente_id", "relacionamento", "responsavelFinanceiro"},
*                  @OA\Property(property="nome", type="string", example="João da Silva"),
*                  @OA\Property(property="cpf", type="string", example="123.456.789-11"),
*                  @OA\Property(property="email", type="string", example="joao@example.com"),
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
*                  @OA\Property(property="paciente_id",type="integer",
*                   description="ID do paciente associado a este responsável (chave estrangeira da tabela pacientes).",
*                   example="1",
*                  ),
*                  @OA\Property(property="parentesco", type="string", example="Pai", nullable=true),
*                  @OA\Property(property="relacionamento", type="string", example="Responsavel", nullable=true),
*                  @OA\Property(property="responsavelFinanceiro", type="boolean", example="true"),
* )
*/
class Responsavel extends Usuario
{
    protected $table = 'pacientes_responsaveis';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = array_merge($this->fillable, [
            // Adicione os campos específicos do modelo Responsável aqui
            'responsavelFinanceiro',
            'paciente_id',
            'relacionamento',
        ]);
    }

    public function paciente(){
        return $this->hasOne(Paciente::class, 'paciente_id');
    }
}
