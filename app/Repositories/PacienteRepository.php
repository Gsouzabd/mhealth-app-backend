<?php

namespace App\Repositories;

use stdClass;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Requests\PacienteRequest;

interface PacienteRepository
{
    /**
     * Recupera todos os pacientes, opcionalmente filtrando-os.
     *
     * @param string|null $filter Filtro opcional para a busca.
     * @return array Lista de pacientes.
     */
    public function getAll(array $filters = null): array;

    /**
     * Encontra um paciente pelo seu identificador único.
     *
     * @param string $id O identificador do paciente.
     * @return Paciente Detalhes do paciente.
     */
    public function findById(string $id): ?Paciente;

    /**
     * Cria um novo paciente com os dados fornecidos.
     *
     * @param array $data Dados para a criação do paciente.
     * @return Paciente O paciente criado.
     */
    public function create(array $data): Paciente;

    /**
     * Exclui um paciente com base em seu identificador único.
     *
     * @param string $id O identificador do paciente.
     */
    public function delete(string $id): void;

    /**
     * Atualiza um paciente com base em seu identificador único.
     *
     * @param string $id O identificador do paciente.
     */
    public function update(array $data, string $id): ?Paciente;
}
