<?php

namespace App\Services;

use App\Models\Responsavel;
use App\Http\Requests\ResponsavelRequest;
use App\Repositories\ResponsavelRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Client\Request;

class ResponsavelService
{
    protected $repository;

    public function __construct(ResponsavelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $filters = null): array
    {
        return $this->repository->getAll($filters);
    }

    public function findById(string $id): ?Responsavel
    {
        $responsavel = $this->repository->findById($id);

        if (!$responsavel) {
            throw new ModelNotFoundException("Responsável não encontrado com o ID: $id");
        }
        return $responsavel;
    }

    public function create(array $data): Responsavel
    {
        return $this->repository->create($data);
    }
    
    public function delete(string $id): void
    {
        $responsavel = $this->repository->findById($id); 
    
        if (!$responsavel) {
            throw new ModelNotFoundException("Não é possível excluir. Responsável não encontrado com o ID: $id");
        }
    
        $this->repository->delete($id);
    }

    public function update(array $data, string $id): ?Responsavel
    {
        $responsavel = $this->repository->findById($id); 
    
        if (!$responsavel) {
            throw new ModelNotFoundException("Não é possível atualizar. Responsável não encontrado com o ID: $id");
        }

        return $this->repository->update($data, $id);
    }
}
