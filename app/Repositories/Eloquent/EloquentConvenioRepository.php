<?php

namespace App\Repositories\Eloquent;

use App\Models\Convenio;
use App\Http\Requests\ConvenioRequest;
use App\Repositories\ConvenioRepository;

class EloquentConvenioRepository implements ConvenioRepository
{
    protected $model;

    public function __construct(Convenio $model)
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


    public function findById(string $id): ?Convenio
    {
        $convenio = $this->model->find($id);
        if(!$convenio){
            return null;
        }

        return $convenio;
    }


    public function create(array $data): Convenio
    {
        $convenio = $this->model->create($data);
        return $convenio;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Convenio
    {
        $convenio = $this->model->find($id);
        if (!$convenio) {
            return null;
        }

        $convenio->update($data);
        return $convenio;
    }

}
