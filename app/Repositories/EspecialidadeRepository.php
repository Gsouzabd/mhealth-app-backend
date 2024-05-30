<?php

namespace App\Repositories;

use App\Models\Especialidade;

interface EspecialidadeRepository
{
    /**
     * Recupera todos os especialidadees, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de especialidades.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um especialidade pelo seu identificador único.
     *
     * @param string $id O identificador do especialidade.
     * @return Especialidade Detalhes do especialidade.
     */
    public function findById(string $id): ?Especialidade;

    /**
     * Cria um novo especialidade com os dados fornecidos.
     *
     * @param array $data Dados para a criação do especialidade.
     * @return Especialidade O especialidade criado.
     */
    public function create(array $data): Especialidade;

    /**
     * Exclui um especialidade com base em seu identificador único.
     *
     * @param string $id O identificador do especialidade.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um especialidade com base em seu identificador único.
     *
     * @param string $id O identificador do especialidade.
     */
    public function update(array $data, string $id): ?Especialidade;
}
