<?php

namespace App\Repositories\Eloquent;

use App\Models\Responsavel;
use App\Http\Requests\ResponsavelRequest;
use App\Repositories\ResponsavelRepository;

class EloquentResponsavelRepository implements ResponsavelRepository
{
    protected $model;

    public function __construct(Responsavel $model)
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


    public function findById(string $id): ?Responsavel
    {
        $responsavel = $this->model->find($id);
        if(!$responsavel){
            return null;
        }

        return $responsavel;
    }


    public function create(array $data): Responsavel
    {
        $responsavel = $this->model->create($data);
        return $responsavel;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Responsavel
    {
        $responsavel = $this->model->find($id);
        if (!$responsavel) {
            return null;
        }

        $responsavel->update($data);
        return $responsavel;
    }

}
