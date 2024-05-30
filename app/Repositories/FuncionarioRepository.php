<?php

namespace App\Repositories;

use App\Models\Funcionario;
use App\Http\Requests\FuncionarioRequest;

interface FuncionarioRepository
{
    /**
     * Recupera todos os funcionários, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de funcionários.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um funcionário pelo seu identificador único.
     *
     * @param string $id O identificador do funcionário.
     * @return Funcionario Detalhes do funcionário.
     */
    public function findById(string $id): ?Funcionario;

    /**
     * Cria um novo funcionário com os dados fornecidos.
     *
     * @param array $data Dados para a criação do funcionário.
     * @return Funcionario O funcionário criado.
     */
    public function create(array $data): Funcionario;

    /**
     * Exclui um funcionário com base em seu identificador único.
     *
     * @param string $id O identificador do funcionário.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um funcionário com base em seu identificador único.
     *
     * @param string $id O identificador do funcionário.
     */
    public function update(array $data, string $id): ?Funcionario;
}
