<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdministradoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('administradores')->insert([
            'nome' => 'admin',
            'cpf' => '00000000000', 
            'email' => 'admin@mlovi.com.br',
            'data_nascimento' => '1990-01-01',
            'sexo' => 'M',
            'password' => Hash::make('Admwebpass0110!@#'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
