<?php

namespace Database\Seeders;

use App\Models\Conselho;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConselhosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conselhos = [
            ['nome' => 'Conselho Federal de Fisioterapia e Terapia Ocupacional', 'sigla' => 'CREFITO' , 'codigo_termo' => '05'],
            ['nome' => 'Conselho Regional de Psicologia', 'sigla' => 'CRP' , 'codigo_termo' => '09'],
            ['nome' => 'Conselho Regional de Nutrição', 'sigla' => 'CRN' , 'codigo_termo' => '07'],
            ['nome' => 'Conselho Regional de Fonoaudiologia', 'sigla' => 'CRFA' , 'codigo_termo' => '04'],
            ['nome' => 'Associação Brasileira de Musicoterapia', 'sigla' => 'ABRAMUS'],
            ['nome' => 'Outros', 'sigla' => 'outros'],
        ];

        foreach ($conselhos as $conselho) {
            Conselho::updateOrCreate(
                ['nome' => $conselho['nome']],
                [
                    'sigla' => $conselho['sigla'],
                    'codigo_termo' => $conselho['codigo_termo'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
