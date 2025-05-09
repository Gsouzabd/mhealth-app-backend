<?php

namespace App\Services;

use App\Models\Funcionario;
use Illuminate\Support\Facades\Hash;
use App\Repositories\FuncionarioRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FuncionarioService
{
    protected $repository;

    public function __construct(FuncionarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $filters = null): array
    {
        return $this->repository->getAll($filters);
    }

    public function findById(string $id): ?Funcionario
    {
        $funcionario = $this->repository->findById($id);

        if (!$funcionario) {
            throw new ModelNotFoundException("Funcionario não encontrado com o ID: $id");
        }
        return $funcionario;
    }

    public function create(array $data): Funcionario
    {
        $data['password'] = Hash::make($data['password']);
        $funcionario = $this->repository->create($data);
        if(isset($data['unidades'])) {
            $unidades = $data['unidades'];
            foreach ($unidades as $unidadeId) {
                $funcionario->unidades()->attach($unidadeId, ['turno_id' => 3]);   
            }
        }
        return $funcionario->load('unidades');
    
    }
    
    public function delete(string $id): void
    {
        $funcionario = $this->repository->findById($id); 
    
        if (!$funcionario) {
            throw new ModelNotFoundException("Não é possível excluir. Funcionario não encontrado com o ID: $id");
        }
    
        $this->repository->delete($id);
    }

    public function update(array $data, string $id): ?Funcionario
    {
        $funcionario = $this->repository->findById($id); 
    
        if (!$funcionario) {
            throw new ModelNotFoundException("Não é possível atualizar. Funcionario não encontrado com o ID: $id");
        }

        if(isset($data['especialidade'])) {
            $especialidades = $data['especialidade'];
            foreach ($especialidades as $especialidadeId) {
                $funcionario->especialidades()->attach($especialidadeId);
            }
        }

        return $this->repository->update($data, $id);
    }
}
