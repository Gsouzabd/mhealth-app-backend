<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Hash;

class FuncionariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Funcionario::create([
            'nome' => 'João Silva',
            'cpf' => '12345678901',
            'email' => 'joao@example.com',
            'data_nascimento' => '1980-01-01',
            'sexo' => 'M',
            'foto' => null,
            'cep' => '12345-678',
            'endereco' => 'Rua Exemplo',
            'numero' => '123',
            'complemento' => 'Apto 101',
            'bairro' => 'Centro',
            'cidade' => 'Exemplo',
            'estado' => 'EX',
            'telefone' => '(00) 1234-5678',
            'celular' => '(00) 98765-4321',
            'pais' => 'Brasil',
            'password' => Hash::make('senha123'),
            'area' => 'Administrativa',
            'administrativo' => true,
            'especialista' => false,
            'especialidade' => null,
            'calendario_id' => null,
            'numConselho' => null,
            'ufConselho' => null,
            'id_conselho' => null,
            'dataUltimoAcesso' => null,
            'system' => null,
            'deviceToken' => null,
            'data_contratacao' => '2020-01-01',
        ]);

        Funcionario::create([
            'nome' => 'Maria Juliana',
            'cpf' => '98765432109',
            'email' => 'maria@example.com',
            'data_nascimento' => '2001-12-22',
            'sexo' => 'F',
            'foto' => null,
            'cep' => '54321-876',
            'endereco' => 'Avenida Teste',
            'numero' => '456',
            'complemento' => 'Bloco B',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'CT',
            'telefone' => '(00) 9876-5432',
            'celular' => '(00) 1234-5678',
            'pais' => 'Brasil',
            'password' => Hash::make('senha456'),
            'area' => 'Aba',
            'administrativo' => false,
            'especialista' => true,
            'especialidade' => 'Psicologia',
            'calendario_id' => null,
            'numConselho' => null,
            'ufConselho' => null,
            'id_conselho' => null,
            'dataUltimoAcesso' => null,
            'system' => null,
            'deviceToken' => null,
            'data_contratacao' => '2019-08-15',
        ]);
    }
}
