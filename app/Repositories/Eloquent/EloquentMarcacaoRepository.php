<?php

namespace App\Repositories\Eloquent;

use App\Models\Marcacao;
use App\Http\Requests\MarcacaoRequest;
use App\Repositories\MarcacaoRepository;

class EloquentMarcacaoRepository implements MarcacaoRepository
{
    protected $model;

    public function __construct(Marcacao $model)
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


    public function findById(string $id): ?Marcacao
    {
        $marcacao = $this->model->find($id);
        if(!$marcacao){
            return null;
        }

        return $marcacao;
    }


    public function create(array $data): Marcacao
    {
        $marcacao = $this->model->create($data);
        return $marcacao;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Marcacao
    {
        $marcacao = $this->model->find($id);
        if (!$marcacao) {
            return null;
        }

        $marcacao->update($data);
        return $marcacao;
    }

}
