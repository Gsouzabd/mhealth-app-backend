<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcedimentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procedimentos = [
            ['nome' => 'Consulta hospitalar em fisioterapia', 'codigo' => '50000349'],
            ['nome' => 'Consulta em psicologia (com diretriz definida pela ANS - nº 105, 106 e 108)', 'codigo' => '50000462'],
            ['nome' => 'Sessão de psicoterapia individual por psicólogo (com diretriz definida pela ANS - nº 105, 106 e 108)', 'codigo' => '50000470'],
            ['nome' => 'Sessão de psicoterapia em grupo por psicólogo (com diretriz definida pela ANS - nº 105, 106 e 108)', 'codigo' => '50000489'],
            ['nome' => 'Consulta ambulatorial por nutricionista (com diretriz definida pela ANS - nº 103)', 'codigo' => '50000560'],
            ['nome' => 'Consulta individual ambulatorial de fonoaudiologia (com diretriz definida pela ANS - nº 104)', 'codigo' => '50000586'],
            ['nome' => 'Consulta individual hospitalar de fonoaudiologia', 'codigo' => '50000608'],
            ['nome' => 'Sessão individual ambulatorial de fonoaudiologia (com diretriz definida pela ANS - nº 104)', 'codigo' => '50000616'],
            ['nome' => 'Sessão individual hospitalar de fonoaudiologia', 'codigo' => '50000632'],
            ['nome' => 'Sessão de fonoaudiologia em grupo (com diretriz definida pela ANS - nº 104)', 'codigo' => '50000640'],
            ['nome' => 'Orientação fonoaudiológica aos pais/escolar/cuidador (com diretriz definida pela ANS - nº 104)', 'codigo' => '50000659'],
            ['nome' => 'Avaliação do processamento auditivo central por fonoaudiólogo (com diretriz definida pela ANS - nº 5)', 'codigo' => '50000675'],
            ['nome' => 'Consulta hospitalar por nutricionista', 'codigo' => '50000691'],
            ['nome' => 'Terapia ABA - Psicologia - Terapias Pediatricas Especiais (com diretriz definida pela ANS - nº 106 e 107)', 'codigo' => '50005103'],
            ['nome' => 'Metodo Teacch - Psicologia - Terapias Pediatricas Especiais (com diretriz definida pela ANS - nº 106 e 107)', 'codigo' => '50005138'],
            ['nome' => 'Metodo PECS - Fonoaudiologia - Terapias Pediatricas Especiais (com diretriz definida pela ANS - nº 104)', 'codigo' => '50005146'],
            ['nome' => 'Terapia ABA - Terapia Ocupacional - Pediatricas Especiais (com diretriz definida pela ANS - nº 106 e 107)', 'codigo' => '50005170'],
            ['nome' => 'Terapia ABA - Fonoaudiologia - Terapias Pediatricas Especiais (com diretriz definida pela ANS - nº 104)', 'codigo' => '50005189'],
            ['nome' => 'Metodo Teacch - Terapia Ocupacional - Terapias Pediatricas Especiais (com diretriz definida pela ANS - nº 106 e 107)', 'codigo' => '50005200'],
            ['nome' => 'Metodo Teacch - Fonoaudiologia - Terapias Pediatricas Especiais (com diretriz definida pela ANS - nº 104)', 'codigo' => '50005219'],
            ['nome' => 'Metodo Denver - Psicologia - Terapias Pediatricas Especiais (com diretriz definida pela ANS - nº 106 e 107)', 'codigo' => '50005227'],
            ['nome' => 'Metodo Denver - Terapia Ocupacional - Terapias Pediatricas Especiais (com diretriz definida pela ANS - nº 106 e 107)', 'codigo' => '50005235'],
            ['nome' => 'Metodo Denver - Fonoaudiologia - Terapias Pediatricas Especiais (com diretriz definida pela ANS - nº 104)', 'codigo' => '50005243'],
            ['nome' => 'Consulta/Avaliação com Fonoaudiólogo (com diretriz definida pela ANS - nº 136)', 'codigo' => '50005316'],
            ['nome' => 'Consulta/Avaliação com Psicólogo (com diretriz definida pela ANS - nº 137)', 'codigo' => '50005324'],
            ['nome' => 'Consulta/Avaliação com Terapeuta Ocupacional (com diretriz definida pela ANS - nº 138)', 'codigo' => '50005332'],
        ];


        foreach ($procedimentos as $proc) {
            DB::table('procedimentos')->insert([
                'nome' => $proc['nome'],
                'codigo' => $proc['codigo'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
