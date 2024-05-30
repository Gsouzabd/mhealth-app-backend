<?php

namespace App\Repositories;

use App\Models\Atendimento;
use App\Http\Requests\AtendimentoRequest;

interface AtendimentoRepository
{
    /**
     * Recupera todos os atendimentoes, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de atendimentos.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um atendimento pelo seu identificador único.
     *
     * @param string $id O identificador do atendimento.
     * @return Atendimento Detalhes do atendimento.
     */
    public function findById(string $id): ?Atendimento;

    /**
     * Encontra os atendimentos pela sua marcação.
     *
     * @param string $id O identificador da marcação.
     * @return array Detalhes do atendimento.
     */
    public function findByMarcacao(string $idMarcacao): array;

    /**
     * Cria um novo atendimento com os dados fornecidos.
     *
     * @param array $data Dados para a criação do atendimento.
     * @return Atendimento O atendimento criado.
     */
    public function create(array $data): Atendimento;

    /**
     * Exclui um atendimento com base em seu identificador único.
     *
     * @param string $id O identificador do atendimento.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um atendimento com base em seu identificador único.
     *
     * @param string $id O identificador do atendimento.
     */
    public function update(array $data, string $id): ?Atendimento;
}
