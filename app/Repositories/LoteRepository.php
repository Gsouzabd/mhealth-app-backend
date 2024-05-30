<?php

namespace App\Repositories;

use App\Models\Lote;

interface LoteRepository
{
    /**
     * Recupera todos os lotees, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de lotes.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um lote pelo seu identificador único.
     *
     * @param string $id O identificador do lote.
     * @return Lote Detalhes do lote.
     */
    public function findById(string $id): ?Lote;

    /**
     * Cria um novo lote com os dados fornecidos.
     *
     * @param array $data Dados para a criação do lote.
     * @return Lote O lote criado.
     */
    public function create(array $data): Lote;

    /**
     * Exclui um lote com base em seu identificador único.
     *
     * @param string $id O identificador do lote.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um lote com base em seu identificador único.
     *
     * @param string $id O identificador do lote.
     */
    public function update(array $data, string $id): ?Lote;

    /**
     * Encontra um lote pelo seu número e id do convenio.
     * @param string $numeroLote O identificador do lote.
     * * @param string $convenioId O id do convenio do lote.
     * @return Lote Detalhes do lote.
     */
    public function findByNumero($numeroLote, $convenioId): ?Lote;


    /**
     * Recupera todos os lotes de um convênio.
     * * @param string $convenioId O id do convenio do lote.
     * @return array Lista de lotes.
     */
    public function findByConvenio($convenioId): array;

}
