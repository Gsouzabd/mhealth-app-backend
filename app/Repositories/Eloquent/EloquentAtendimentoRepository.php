<?php

namespace App\Repositories\Eloquent;

use App\Models\Atendimento;
use App\Repositories\AtendimentoRepository;

class EloquentAtendimentoRepository implements AtendimentoRepository
{
    protected $model;

    public function __construct(Atendimento $model)
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


    public function findById(string $id): ?Atendimento
    {
        $atendimento = $this->model->find($id);
        if(!$atendimento){
            return null;
        }

        return $atendimento;
    }

    public function findByMarcacao(string $idMarcacao): array
    {
        $atendimentos = $this->model->where('id_marcacao', $idMarcacao)->get();

        return $atendimentos;
    }


    public function create(array $data): Atendimento
    {
        $atendimento = $this->model->create($data);
        return $atendimento;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Atendimento
    {
        $atendimento = $this->model->find($id);
        if (!$atendimento) {
            return null;
        }

        $atendimento->update($data);
        return $atendimento;
    }

}
