<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionariosUnidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Relacionamentos específicos a serem inseridos
        $relacoes = [
            ['funcionario_id' => 1, 'unidade_id' => 2, 'turno_id' => 1],
            ['funcionario_id' => 2, 'unidade_id' => 1, 'turno_id' => 2],
            ['funcionario_id' => 1, 'unidade_id' => 1, 'turno_id' => 2],
            ['funcionario_id' => 2, 'unidade_id' => 2, 'turno_id' => 3],
        ];

        // Inserir cada relação na tabela
        foreach ($relacoes as $relacao) {
            DB::table('funcionarios_unidades')->insert([
                'funcionario_id' => $relacao['funcionario_id'],
                'unidade_id' => $relacao['unidade_id'],
                'turno_id' => $relacao['turno_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
