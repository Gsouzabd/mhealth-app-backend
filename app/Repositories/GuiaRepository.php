<?php

namespace App\Repositories;

use App\Models\Guia;

interface GuiaRepository
{
    /**
     * Recupera todos os guiaes, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de guias.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um guia pelo seu identificador único.
     *
     * @param string $id O identificador do guia.
     * @return Guia Detalhes do guia.
     */
    public function findById(string $id): ?Guia;

    /**
     * Cria um novo guia com os dados fornecidos.
     *
     * @param array $data Dados para a criação do guia.
     * @return Guia O guia criado.
     */
    public function create(array $data): Guia;

    /**
     * Exclui um guia com base em seu identificador único.
     *
     * @param string $id O identificador do guia.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um guia com base em seu identificador único.
     *
     * @param string $id O identificador do guia.
     */
    public function update(array $data, string $id): ?Guia;
}
