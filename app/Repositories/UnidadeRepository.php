<?php

namespace App\Repositories;

use App\Models\Unidade;

interface UnidadeRepository
{
    /**
     * Recupera todos os unidadees, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de unidades.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um unidade pelo seu identificador único.
     *
     * @param string $id O identificador do unidade.
     * @return Unidade Detalhes do unidade.
     */
    public function findById(string $id): ?Unidade;

    /**
     * Cria um novo unidade com os dados fornecidos.
     *
     * @param array $data Dados para a criação do unidade.
     * @return Unidade O unidade criado.
     */
    public function create(array $data): Unidade;

    /**
     * Exclui um unidade com base em seu identificador único.
     *
     * @param string $id O identificador do unidade.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um unidade com base em seu identificador único.
     *
     * @param string $id O identificador do unidade.
     */
    public function update(array $data, string $id): ?Unidade;
}
