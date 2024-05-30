<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\MarcacaoTipoRecorrencia;
use App\Models\Especialidade;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdministradoresSeeder::class,
            ConveniosSeeder::class,
            ConselhosSeeder::class,
            EspecialidadesSeeder::class,
            FuncionariosSeeder::class,
            PacientesTableSeeder::class,
            PacientesResponsaveisTableSeeder::class,
            ProcedimentosTableSeeder::class,
            TurnosTableSeeder::class,
            UnidadesTableSeeder::class,
            FuncionariosUnidadesTableSeeder::class,
            MarcacoesTableSeeder::class,
            EstabelecimentosTableSeeder::class
        ]);
    }
}
