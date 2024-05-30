<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unidades = [
            [
                'nome' => 'Unidade Ilha do Leite',
                'endereco' => 'Av. Frei Matias Teves, 280 - Ilha do Leite, Recife - PE, 50070-465'
            ],
            [
                'nome' => 'Unidade Boa Viagem',
                'endereco' => 'Rua Exemplo, 123 - Boa Viagem, Recife - PE, 51020-230'
            ]
        ];

        foreach ($unidades as $unidade) {
            DB::table('unidades')->insert([
                'nome' => $unidade['nome'],
                'endereco' => $unidade['endereco']
            ]);
        }
    }
}
