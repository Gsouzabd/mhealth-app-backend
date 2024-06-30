<?php

namespace App\Repositories;

use App\Models\Consulta;
use App\Http\Requests\ConsultaRequest;

interface ConsultaRepository
{
    /**
     * Recupera todos os consultaes, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de consultas.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um consulta pelo seu identificador único.
     *
     * @param string $id O identificador do consulta.
     * @return Consulta Detalhes do consulta.
     */
    public function findById(string $id): ?Consulta;

    /**
     * Cria um novo consulta com os dados fornecidos.
     *
     * @param array $data Dados para a criação do consulta.
     * @return Consulta O consulta criado.
     */
    public function create(array $data): Consulta;

    /**
     * Exclui um consulta com base em seu identificador único.
     *
     * @param string $id O identificador do consulta.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um consulta com base em seu identificador único.
     *
     * @param string $id O identificador do consulta.
     */
    public function update(array $data, string $id): ?Consulta;
}
