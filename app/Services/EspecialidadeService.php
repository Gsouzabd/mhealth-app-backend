<?php

namespace App\Services;

use App\Models\Especialidade;
use App\Repositories\EspecialidadeRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EspecialidadeService
{
    protected $repository;

    public function __construct(EspecialidadeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $filters = null): array
    {
        return $this->repository->getAll($filters);
    }

    public function findById(string $id): ?Especialidade
    {
        $especialidade = $this->repository->findById($id);

        if (!$especialidade) {
            throw new ModelNotFoundException("Especialidade não encontrado com o ID: $id");
        }
        return $especialidade;
    }

    public function create(array $data): Especialidade
    {
        return $this->repository->create($data);
    }

    public function delete(string $id): void
    {
        $especialidade = $this->repository->findById($id);

        if (!$especialidade) {
            throw new ModelNotFoundException("Não é possível excluir. Especialidade não encontrado com o ID: $id");
        }

        $this->repository->delete($id);
    }

    public function update(array $data, string $id): ?Especialidade
    {
        $especialidade = $this->repository->findById($id);

        if (!$especialidade) {
            throw new ModelNotFoundException("Não é possível atualizar. Especialidade não encontrado com o ID: $id");
        }

        return $this->repository->update($data, $id);
    }
}
