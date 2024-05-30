<?php

namespace App\Services;

use App\Models\Convenio;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ConvenioRequest;
use App\Repositories\ConvenioRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ConvenioService
{
    protected $repository;

    public function __construct(ConvenioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $filters = null): array
    {
        return $this->repository->getAll($filters);
    }

    public function findById(string $id): ?Convenio
    {
        $convenio = $this->repository->findById($id);

        if (!$convenio) {
            throw new ModelNotFoundException("Convenio não encontrado com o ID: $id");
        }
        return $convenio;
    }

    public function create(array $data): Convenio
    {
        return $this->repository->create($data);
    }

    public function delete(string $id): void
    {
        $convenio = $this->repository->findById($id);

        if (!$convenio) {
            throw new ModelNotFoundException("Não é possível excluir. Convenio não encontrado com o ID: $id");
        }

        $this->repository->delete($id);
    }

    public function update(array $data, string $id): ?Convenio
    {
        $convenio = $this->repository->findById($id);

        if (!$convenio) {
            throw new ModelNotFoundException("Não é possível atualizar. Convenio não encontrado com o ID: $id");
        }

        return $this->repository->update($data, $id);
    }
}
