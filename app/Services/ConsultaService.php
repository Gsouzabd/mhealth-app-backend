<?php

namespace App\Services;

use App\Models\Consulta;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ConsultaRequest;
use App\Repositories\ConsultaRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ConsultaService
{
    protected $repository;

    public function __construct(ConsultaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $filters = null): array
    {
        return $this->repository->getAll($filters);
    }

    public function findById(string $id): ?Consulta
    {
        $consulta = $this->repository->findById($id);

        if (!$consulta) {
            throw new ModelNotFoundException("Consulta não encontrado com o ID: $id");
        }
        return $consulta;
    }

    public function create(array $data): Consulta
    {
        return $this->repository->create($data);
    }

    public function delete(string $id): void
    {
        $consulta = $this->repository->findById($id);

        if (!$consulta) {
            throw new ModelNotFoundException("Não é possível excluir. Consulta não encontrado com o ID: $id");
        }

        $this->repository->delete($id);
    }

    public function update(array $data, string $id): ?Consulta
    {
        $consulta = $this->repository->findById($id);

        if (!$consulta) {
            throw new ModelNotFoundException("Não é possível atualizar. Consulta não encontrado com o ID: $id");
        }

        return $this->repository->update($data, $id);
    }
}
