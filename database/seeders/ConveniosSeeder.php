<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Convenio;

class ConveniosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $convenios = [
            [
                'nome' => 'Amil',
                'diasCarencia' => 30,
                'geraReceitas' => true,
                'numeroderegistro' => '326305',
                'codigonaoperadora' => null,
                'versaoxml' => '',
                'tabela' => '00',
                'maxSessoesTiss' => 100,
            ],
            [
                'nome' => 'Bradesco Empresarial',
                'diasCarencia' => 60,
                'geraReceitas' => true,
                'numeroderegistro' => '005711',
                'codigonaoperadora' => null,
                'versaoxml' => '',
                'tabela' => '00',
                'maxSessoesTiss' => 150,
            ],
            // Adicione as informações dos outros convênios aqui
        ];

        foreach ($convenios as $convenio) {
            Convenio::create($convenio);
        }
    }
}
