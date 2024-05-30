<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TurnosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $turnos = [
            ['nome' => 'manhã'],
            ['nome' => 'tarde'],
            ['nome' => 'noite'],
            ['nome' => 'integral'],
        ];

        foreach ($turnos as $turno) {
            DB::table('turnos')->insert([
                'nome' => $turno['nome']
            ]);
        }
    }
}
