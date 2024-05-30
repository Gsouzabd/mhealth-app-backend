<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Especialidade; // Certifique-se de importar o modelo Especialidade se necessário

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidades = [
            ['nome' => 'Terapia ocupacional', 'descricao' => '', 'cbos' => '225105', 'conselho_id' => '1'],
            ['nome' => 'Fisioterapia', 'descricao' => '', 'cbos' => '223405', 'conselho_id' => '1'],
            ['nome' => 'Psicopedagogia', 'descricao' => '', 'cbos' => '239425', 'conselho_id' => '5'],
            ['nome' => 'Psicologia', 'descricao' => '', 'cbos' => '251510', 'conselho_id' => '2'],
            ['nome' => 'Nutrição', 'descricao' => '', 'cbos' => '223105', 'conselho_id' => '3'],
            ['nome' => 'Musicoterapia', 'descricao' => '', 'cbos' => '226305', 'conselho_id' => '4'],
            ['nome' => 'Psicomotricidade', 'descricao' => '', 'cbos' => '223915', 'conselho_id' => '5'],
        ];

        foreach ($especialidades as $especialidade) {
            Especialidade::updateOrCreate(
                ['nome' => $especialidade['nome']], // Verifica se já existe uma especialidade com esse nome
                [
                    'descricao' => $especialidade['descricao'],
                    'cbos' => $especialidade['cbos'],
                    'conselho_id' => $especialidade['conselho_id'], // Adicionando o campo 'conselho_id'
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
