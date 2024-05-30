<?php

namespace App\Repositories;

use App\Models\Responsavel;
use App\Http\Requests\ResponsavelRequest;

interface ResponsavelRepository
{
    /**
     * Recupera todos os responsávels, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de responsávels.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um responsável pelo seu identificador único.
     *
     * @param string $id O identificador do responsável.
     * @return Responsavel Detalhes do responsável.
     */
    public function findById(string $id): ?Responsavel;

    /**
     * Cria um novo responsável com os dados fornecidos.
     *
     * @param array $data Dados para a criação do responsável.
     * @return Responsavel O responsável criado.
     */
    public function create(array $data): Responsavel;

    /**
     * Exclui um responsável com base em seu identificador único.
     *
     * @param string $id O identificador do responsável.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um responsável com base em seu identificador único.
     *
     * @param string $id O identificador do responsável.
     */
    public function update(array $data, string $id): ?Responsavel;
}
