<?php

namespace App\Repositories\Eloquent;

use App\Models\Consulta;
use App\Http\Requests\ConsultaRequest;
use App\Repositories\ConsultaRepository;

class EloquentConsultaRepository implements ConsultaRepository
{
    protected $model;

    public function __construct(Consulta $model)
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


    public function findById(string $id): ?Consulta
    {
        $consulta = $this->model->find($id);
        if(!$consulta){
            return null;
        }

        return $consulta;
    }


    public function create(array $data): Consulta
    {
        $consulta = $this->model->create($data);
        return $consulta;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Consulta
    {
        $consulta = $this->model->find($id);
        if (!$consulta) {
            return null;
        }

        $consulta->update($data);
        return $consulta;
    }

}
