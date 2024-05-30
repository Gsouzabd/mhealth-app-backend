<?php

namespace App\Repositories;

use App\Models\Convenio;
use App\Http\Requests\ConvenioRequest;

interface ConvenioRepository
{
    /**
     * Recupera todos os convenioes, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de convenios.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um convenio pelo seu identificador único.
     *
     * @param string $id O identificador do convenio.
     * @return Convenio Detalhes do convenio.
     */
    public function findById(string $id): ?Convenio;

    /**
     * Cria um novo convenio com os dados fornecidos.
     *
     * @param array $data Dados para a criação do convenio.
     * @return Convenio O convenio criado.
     */
    public function create(array $data): Convenio;

    /**
     * Exclui um convenio com base em seu identificador único.
     *
     * @param string $id O identificador do convenio.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um convenio com base em seu identificador único.
     *
     * @param string $id O identificador do convenio.
     */
    public function update(array $data, string $id): ?Convenio;
}
