<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\MarcacaoTipoRecorrencia;
use Carbon\Carbon;

class MarcacoesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('marcacoes')->insert([
            [
                'id_paciente' => 1,
                'id_funcionario' => 2,
                'id_especialidade' => 1,
                'horario' => '14:00:00',
                'convenio' => 1,
                'data_inicial' => '2024-03-23',
                'duracao' => 60,
                'recorrencia' => true,
                'tipoRecorrencia' => getTipoRecorrencia('value', 'semanal'), // Usando o nome do enum
                'vezesRecorrencia' => 4,
                'marcadoPor' => 1,
                'unidade' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
