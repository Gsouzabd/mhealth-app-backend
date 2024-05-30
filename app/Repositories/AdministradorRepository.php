<?php

namespace App\Repositories;

use App\Models\Administrador;
use App\Http\Requests\AdministradorRequest;

interface AdministradorRepository
{
    /**
     * Recupera todos os administradores, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de administradors.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um administrador pelo seu identificador único.
     *
     * @param string $id O identificador do administrador.
     * @return Administrador Detalhes do administrador.
     */
    public function findById(string $id): ?Administrador;

    /**
     * Cria um novo administrador com os dados fornecidos.
     *
     * @param array $data Dados para a criação do administrador.
     * @return Administrador O administrador criado.
     */
    public function create(array $data): Administrador;

    /**
     * Exclui um administrador com base em seu identificador único.
     *
     * @param string $id O identificador do administrador.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um administrador com base em seu identificador único.
     *
     * @param string $id O identificador do administrador.
     */
    public function update(array $data, string $id): ?Administrador;
}
