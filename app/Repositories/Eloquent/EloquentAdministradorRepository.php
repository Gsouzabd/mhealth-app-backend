<?php

namespace App\Repositories\Eloquent;

use App\Models\Administrador;
use App\Http\Requests\AdministradorRequest;
use App\Repositories\AdministradorRepository;

class EloquentAdministradorRepository implements AdministradorRepository
{
    protected $model;

    public function __construct(Administrador $model)
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


    public function findById(string $id): ?Administrador
    {
        $administrador = $this->model->find($id);
        if(!$administrador){
            return null;
        }

        return $administrador;
    }


    public function create(array $data): Administrador
    {
        $administrador = $this->model->create($data);
        return $administrador;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Administrador
    {
        $administrador = $this->model->find($id);
        if (!$administrador) {
            return null;
        }

        $administrador->update($data);
        return $administrador;
    }

}
