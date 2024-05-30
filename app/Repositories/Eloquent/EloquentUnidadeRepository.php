<?php

namespace App\Repositories\Eloquent;

use App\Models\Unidade;
use App\Http\Requests\UnidadeRequest;
use App\Repositories\UnidadeRepository;

class EloquentUnidadeRepository implements UnidadeRepository
{
    protected $model;

    public function __construct(Unidade $model)
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


    public function findById(string $id): ?Unidade
    {
        $unidade = $this->model->find($id);
        if(!$unidade){
            return null;
        }

        return $unidade;
    }


    public function create(array $data): Unidade
    {
        $unidade = $this->model->create($data);
        return $unidade;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Unidade
    {
        $unidade = $this->model->find($id);
        if (!$unidade) {
            return null;
        }

        $unidade->update($data);
        return $unidade;
    }

}
