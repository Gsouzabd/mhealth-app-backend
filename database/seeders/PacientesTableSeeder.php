<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacientesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pacientes')->insert([
            [
                'nome' => 'André Villa-Lobos',
                'cpf' => '11111111111',
                'email' => 'paciente1@example.com',
                'cep' => '54792560',
                'data_nascimento' => '1990-01-01',
                'sexo' => 'M',
                'cns' => '123456789012345',
                'diagnostico' => 'Transtorno do Espectro Autista - Leve',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Carlos Eduardo',
                'cpf' => '22222222222',
                'email' => 'paciente2@example.com',
                'cep' => '54792562',
                'data_nascimento' => '1991-02-02',
                'sexo' => 'M',
                'cns' => '234567890123456',
                'diagnostico' => 'Transtorno do Espectro Autista - Moderado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Sharon Gray',
                'cpf' => '33333333333',
                'email' => 'paciente3@example.com',
                'cep' => '54792563',
                'data_nascimento' => '1992-03-03',
                'sexo' => 'F',
                'cns' => '345678901234567',
                'diagnostico' => 'Transtorno do Espectro Autista - Severo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'John Doe',
                'cpf' => '44444444444',
                'email' => 'paciente4@example.com',
                'cep' => '54792564',
                'data_nascimento' => '1993-04-04',
                'sexo' => 'M',
                'cns' => '456789012345678',
                'diagnostico' => 'Transtorno do Espectro Autista - Leve',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Ashley Sandler',
                'cpf' => '55555555555',
                'email' => 'paciente5@example.com',
                'cep' => '54792565',
                'data_nascimento' => '1994-05-05',
                'sexo' => 'F',
                'cns' => '567890123456789',
                'diagnostico' => 'Transtorno do Espectro Autista - Moderado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
