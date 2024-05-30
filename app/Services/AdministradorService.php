<?php

namespace App\Services;

use App\Models\Administrador;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdministradorRequest;
use App\Repositories\AdministradorRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdministradorService
{
    protected $repository;

    public function __construct(AdministradorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $filters = null): array
    {
        return $this->repository->getAll($filters);
    }

    public function findById(string $id): ?Administrador
    {
        $administrador = $this->repository->findById($id);

        if (!$administrador) {
            throw new ModelNotFoundException("Administrador não encontrado com o ID: $id");
        }
        return $administrador;
    }

    public function create(array $data): Administrador
    {
        $data['password'] = Hash::make($data['password']);

        return $this->repository->create($data);
    }
    
    public function delete(string $id): void
    {
        $administrador = $this->repository->findById($id); 
    
        if (!$administrador) {
            throw new ModelNotFoundException("Não é possível excluir. Administrador não encontrado com o ID: $id");
        }
    
        $this->repository->delete($id);
    }

    public function update(array $data, string $id): ?Administrador
    {
        $administrador = $this->repository->findById($id); 
    
        if (!$administrador) {
            throw new ModelNotFoundException("Não é possível atualizar. Administrador não encontrado com o ID: $id");
        }

        return $this->repository->update($data, $id);
    }
}
