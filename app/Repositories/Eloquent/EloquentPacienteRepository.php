<?php

namespace App\Repositories\Eloquent;

use stdClass;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Requests\PacienteRequest;
use App\Repositories\PacienteRepository;

class EloquentPacienteRepository implements PacienteRepository
{
    protected $model;

    public function __construct(Paciente $model)
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


    public function findById(string $id): ?Paciente
    {
        $paciente = $this->model->find($id);
        if(!$paciente){
            return null;
        }

        return $paciente;
    }


    public function create(array $data): Paciente
    {
        $paciente = $this->model->create($data);
        return $paciente;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function update(array $data, string $id): ?Paciente
    {
        
        $paciente = $this->model->find($id);

        if (!$paciente) {
            return null;
        }

        $paciente->update($data);
        return $paciente;
    }

}
