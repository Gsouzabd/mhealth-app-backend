<?php

namespace App\Services;

use App\Models\Paciente;
use App\Repositories\PacienteRepository;
use App\Repositories\ResponsavelRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PacienteService
{
    protected $pacienteRepository;
    protected $responsavelRepository;

    public function __construct(PacienteRepository $pacienteRepository, ResponsavelRepository $responsavelRepository)
    {
        $this->pacienteRepository = $pacienteRepository;
        $this->responsavelRepository = $responsavelRepository;
    }

    public function getAll(array $filters = null): array
    {
        return $this->pacienteRepository->getAll($filters);
    }

    public function findById(string $id): ?Paciente
    {
        $paciente = $this->pacienteRepository->findById($id);

        if (!$paciente) {
            throw new ModelNotFoundException("Paciente não encontrado com o ID: $id");
        }
        return $paciente;
    }

    public function create(array $data): ?Paciente
    {
        // Cria o paciente e obtém o modelo criado
        $paciente = $this->pacienteRepository->create($data);

        // Cria o(s) responsável(is) associado(s) ao paciente
        $responsaveis = [];
        $responsaveisArray = isset($data['responsaveis']) ? $data['responsaveis'] : [];
        if(count($responsaveisArray) > 0) {
            foreach ($responsaveisArray as $responsavelData) {
                $responsavelData['responsavelFinanceiro'] = $responsavelData['responsavelFinanceiro'] == true ? 1 : 0;
                $responsavelData['paciente_id'] = $paciente->id;
                $responsaveis[] = $this->responsavelRepository->create($responsavelData);
            }

            if(isset($data['convenios'])) {
                $convenios = $data['convenios'];
                foreach ($convenios as $convenioId) {
                    $paciente->convenios()->attach($convenioId);
                }
            }
        }

        return $paciente;
    }


    public function delete(string $id): void
    {
        $paciente = $this->pacienteRepository->findById($id);

        if (!$paciente) {
            throw new ModelNotFoundException("Não é possível excluir. Paciente não encontrado com o ID: $id");
        }

        $this->pacienteRepository->delete($id);
    }


    public function update(array $data, string $id): ?Paciente
    {
        $paciente = $this->pacienteRepository->findById($id);

        if (!$paciente) {
            throw new ModelNotFoundException("Não é possível atualizar. Paciente não encontrado com o ID: $id");
        }

        return $this->pacienteRepository->update($data, $id);
    }


    public function getResponsaveis(string $idPaciente) {
        $paciente = $this->pacienteRepository->findById($idPaciente);
        if (!$paciente) {
            throw new ModelNotFoundException("Paciente não encontrado com o ID: $idPaciente");
        }
        return $paciente->responsaveis;
    }

}
