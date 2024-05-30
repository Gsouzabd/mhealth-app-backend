<?php

namespace App\Repositories\Eloquent;

use App\Models\Funcionario;
use App\Repositories\FuncionarioRepository;

class EloquentFuncionarioRepository implements FuncionarioRepository
{
    protected $model;

    public function __construct(Funcionario $model)
    {
        $this->model = $model;
    }


    public function getAll(array $filters = null): array
    {
        return $this->model
                    ->where(function ($query) use ($filters){
                        if($filters){
                            foreach ($filters as $field => $value) {
                                if (!empty($value)) {
                                    $query->where($field, 'like', "%{$value}%");
                                }
                            }
                        }
                    })
                    ->get()
                    ->toArray();
    }


    public function findById(string $id): ?Funcionario
    {
        $funcionario = $this->model->find($id);
        if(!$funcionario){
            return null;
        }

        return $funcionario;
    }


    public function create(array $data): Funcionario
    {
        $funcionario = $this->model->create($data);
        return $funcionario;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Funcionario
    {
        $funcionario = $this->model->find($id);
        if (!$funcionario) {
            return null;
        }
        $funcionario->update($data);

        return $funcionario;
    }

}
