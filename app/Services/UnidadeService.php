<?php

namespace App\Services;

use App\Models\Unidade;
use App\Repositories\UnidadeRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UnidadeService
{
    protected $repository;

    public function __construct(UnidadeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $filters = null): array
    {
        return $this->repository->getAll($filters);
    }

    public function findById(string $id): ?Unidade
    {
        $unidade = $this->repository->findById($id);

        if (!$unidade) {
            throw new ModelNotFoundException("Unidade não encontrado com o ID: $id");
        }
        return $unidade;
    }

    public function create(array $data): Unidade
    {
        return $this->repository->create($data);
    }

    public function delete(string $id): void
    {
        $unidade = $this->repository->findById($id);

        if (!$unidade) {
            throw new ModelNotFoundException("Não é possível excluir. Unidade não encontrado com o ID: $id");
        }

        $this->repository->delete($id);
    }

    public function update(array $data, string $id): ?Unidade
    {
        $unidade = $this->repository->findById($id);

        if (!$unidade) {
            throw new ModelNotFoundException("Não é possível atualizar. Unidade não encontrado com o ID: $id");
        }

        return $this->repository->update($data, $id);
    }
}
