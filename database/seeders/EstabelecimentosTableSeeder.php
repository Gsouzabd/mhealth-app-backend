<?php

namespace Database\Seeders;

use App\Models\Estabelecimento;
use Illuminate\Database\Seeder;

class EstabelecimentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Exemplo de dados para inserção
        $estabelecimentos = [
            [
                'nome' => 'Estabelecimento 1',
                'nome_empresarial' => 'Empresa 1 LTDA',
                'endereco' => 'Rua A, 123',
                'telefone' => '123456789',
                'cnes' => '1234567',
                'natureza_juridica' => 'Natureza 1',
                'gestao' => 'Gestao 1',
                'cnpj' => '12345678901234',
                'dependencia' => 'DEPENDENCIA 1',
            ],
            [
                'nome' => 'Estabelecimento 2',
                'nome_empresarial' => 'Empresa 2 LTDA',
                'endereco' => 'Rua B, 456',
                'telefone' => '987654321',
                'cnes' => '7654321',
                'natureza_juridica' => 'Natureza 2',
                'gestao' => 'Gestao 2',
                'cnpj' => '98765432109876',
                'dependencia' => 'DEPENDENCIA 2',
            ],
        ];


        foreach ($estabelecimentos as $estabelecimentoData) {
            Estabelecimento::create($estabelecimentoData);
        }
    }
}
