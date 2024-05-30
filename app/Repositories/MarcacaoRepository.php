<?php

namespace App\Repositories;

use App\Models\Marcacao;
use App\Http\Requests\MarcacaoRequest;

interface MarcacaoRepository
{
    /**
     * Recupera todos os  marcacaoes, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de Marcaçoes.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um  marcacao pelo seu identificador único.
     *
     * @param string $id O identificador do marcacao.
     * @return  marcacao Detalhes do marcacao.
     */
    public function findById(string $id): ? marcacao;

    /**
     * Cria um novo  marcacao com os dados fornecidos.
     *
     * @param array $data Dados para a criação do  marcacao.
     * @return  marcacao O  marcacao criado.
     */
    public function create(array $data):  marcacao;

    /**
     * Exclui um  marcacao com base em seu identificador único.
     *
     * @param string $id O identificador do  marcacao.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um  marcacao com base em seu identificador único.
     *
     * @param string $id O identificador do  marcacao.
     */
    public function update(array $data, string $id): ? marcacao;
}
