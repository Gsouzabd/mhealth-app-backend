<?php

namespace App\Repositories\Eloquent;

use App\Models\Especialidade;
use App\Http\Requests\EspecialidadeRequest;
use App\Repositories\EspecialidadeRepository;

class EloquentEspecialidadeRepository implements EspecialidadeRepository
{
    protected $model;

    public function __construct(Especialidade $model)
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


    public function findById(string $id): ?Especialidade
    {
        $especialidade = $this->model->find($id);
        if(!$especialidade){
            return null;
        }

        return $especialidade;
    }


    public function create(array $data): Especialidade
    {
        $especialidade = $this->model->create($data);
        return $especialidade;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Especialidade
    {
        $especialidade = $this->model->find($id);
        if (!$especialidade) {
            return null;
        }

        $especialidade->update($data);
        return $especialidade;
    }

}
