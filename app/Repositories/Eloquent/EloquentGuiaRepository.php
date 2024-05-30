<?php

namespace App\Repositories\Eloquent;

use App\Models\Guia;
use App\Http\Requests\GuiaRequest;
use App\Repositories\GuiaRepository;

class EloquentGuiaRepository implements GuiaRepository
{
    protected $model;

    public function __construct(Guia $model)
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


    public function findById(string $id): ?Guia
    {
        $guia = $this->model->find($id);
        if(!$guia){
            return null;
        }

        return $guia;
    }


    public function create(array $data): Guia
    {
        $guia = $this->model->create($data);
        return $guia;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Guia
    {
        $guia = $this->model->find($id);
        if (!$guia) {
            return null;
        }

        $guia->update($data);
        return $guia;
    }

}
