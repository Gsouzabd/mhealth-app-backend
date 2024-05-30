<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacientesResponsaveisTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pacientes_responsaveis')->insert([
            [
                'nome' => 'Responsável Um',
                'cpf' => '66666666666',
                'email' => 'responsavel1@example.com',
                'data_nascimento' => '1970-01-01',
                'celular' => '11999999991',
                'sexo' => 'F',
                'responsavelFinanceiro' => true,
                'relacionamento' => 'Mãe',
                'created_at' => now(),
                'updated_at' => now(),
                'paciente_id' => 1
            ],
            [
                'nome' => 'Responsável Dois',
                'cpf' => '77777777777',
                'email' => 'responsavel2@example.com',
                'data_nascimento' => '1971-02-02',
                'celular' => '11999999992',
                'sexo' => 'M',
                'responsavelFinanceiro' => false,
                'relacionamento' => 'Pai',
                'created_at' => now(),
                'updated_at' => now(),
                'paciente_id' => 2
            ],
            [
                'nome' => 'Responsável Três',
                'cpf' => '88888888888',
                'email' => 'responsavel3@example.com',
                'data_nascimento' => '1972-03-03',
                'celular' => '11999999993',
                'sexo' => 'F',
                'responsavelFinanceiro' => true,
                'relacionamento' => 'Tio',
                'created_at' => now(),
                'updated_at' => now(),
                'paciente_id' => 3
            ],
            [
                'nome' => 'Responsável Quatro',
                'cpf' => '99999999999',
                'email' => 'responsavel4@example.com',
                'data_nascimento' => '1973-04-04',
                'celular' => '11999999994',
                'sexo' => 'M',
                'responsavelFinanceiro' => false,
                'relacionamento' => 'Avô',
                'created_at' => now(),
                'updated_at' => now(),
                'paciente_id' => 4
            ],
            [
                'nome' => 'Responsável Cinco',
                'cpf' => '00000000000',
                'email' => 'responsavel5@example.com',
                'data_nascimento' => '1974-05-05',
                'celular' => '11999999995',
                'sexo' => 'F',
                'responsavelFinanceiro' => true,
                'relacionamento' => 'Irmão',
                'created_at' => now(),
                'updated_at' => now(),
                'paciente_id' => 5
            ],
            [
                'nome' => 'Responsável Dois Financeiro',
                'cpf' => '77777777778',
                'email' => 'responsavel6@example.com',
                'data_nascimento' => '1971-03-05',
                'celular' => '11999999992',
                'sexo' => 'F',
                'responsavelFinanceiro' => true,
                'relacionamento' => 'Mãe',
                'created_at' => now(),
                'updated_at' => now(),
                'paciente_id' => 2
            ],
            [
                'nome' => 'Responsável Quatro Financeiro',
                'cpf' => '99999999995',
                'email' => 'responsavel7@example.com',
                'data_nascimento' => '1993-01-06',
                'celular' => '11999999994',
                'sexo' => 'M',
                'responsavelFinanceiro' => true,
                'relacionamento' => 'Pai',
                'created_at' => now(),
                'updated_at' => now(),
                'paciente_id' => 4
            ]

        ]);
    }
}
