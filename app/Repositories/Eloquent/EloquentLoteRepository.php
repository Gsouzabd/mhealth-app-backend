<?php

namespace App\Repositories\Eloquent;

use App\Models\Lote;
use App\Http\Requests\LoteRequest;
use App\Repositories\LoteRepository;

class EloquentLoteRepository implements LoteRepository
{
    protected $model;

    public function __construct(Lote $model)
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


    public function findById(string $id): ?Lote
    {
        $lote = $this->model->find($id);
        if(!$lote){
            return null;
        }

        return $lote;
    }


    public function create(array $data): Lote
    {
        $lote = $this->model->create($data);
        return $lote;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Lote
    {
        $lote = $this->model->find($id);
        if (!$lote) {
            return null;
        }

        $lote->update($data);
        return $lote;
    }

    public function findByNumero($numeroLote, $convenioId): ?Lote
    {
        return $this->model::where('id_convenio', $convenioId)
                            ->where('numero', $numeroLote)
                            ->first();
    }

    public function findByConvenio($convenioId): array
    {
        return $this->model
            ->where('id_convenio', $convenioId)
            ->get()
            ->toArray();
    }


}
