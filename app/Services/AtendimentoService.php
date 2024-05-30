<?php

namespace App\Services;

use App\Enums\AtendimentoStatus;
use App\Models\Atendimento;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AtendimentoRequest;
use App\Repositories\AtendimentoRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class AtendimentoService
{
    protected $repository;

    public function __construct(AtendimentoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $filters = null): array
    {
        return $this->repository->getAll($filters);
    }

    public function findById(string $id): ?Atendimento
    {
        $atendimento = $this->repository->findById($id);

        if (!$atendimento) {
            throw new ModelNotFoundException("Atendimento não encontrado com o ID: $id");
        }
        return $atendimento;
    }

    public function findByMarcacao(string $idMarcacao): array
    {
        $atendimentos = $this->repository->findByMarcacao($idMarcacao);

        if (!$atendimentos) {
            throw new ModelNotFoundException("Atendimento não encontrado com o ID Marcação: $idMarcacao");
        }
        return $atendimentos;
    }

    public function create(array $data): Atendimento
    {
        return $this->repository->create($data);
    }

    public function createAtendimentosRecorrente($vezes, $marcacao, $semanas): void
    {
        $dataInicial = Carbon::parse($marcacao->data_inicial);

        $primeiroAtendimento = $this->repository->create([
            'id_marcacao' => $marcacao->id,
            'data' => $dataInicial,
            'status' => getAtendimentoStatus('value', 'marcado'),
            'recorrente' => true,
            'horario' => $marcacao->horario,
            'duracao' => $marcacao->duracao,
        ]);

        if($primeiroAtendimento){
            for ($i = 1; $i < $vezes; $i++) {
                $this->repository->create([
                    'id_marcacao' => $marcacao->id,
                    'data' => $dataInicial->addWeek($semanas * $i),
                    'status' => getAtendimentoStatus('value', 'marcado'),
                    'recorrente' => true,
                    'horario' => $marcacao->horario,
                    'duracao' => $marcacao->duracao,
                ]);
            }
        }
    }

    public function delete(string $id): void
    {
        $atendimento = $this->repository->findById($id);

        if (!$atendimento) {
            throw new ModelNotFoundException("Não é possível excluir. Atendimento não encontrado com o ID: $id");
        }

        $this->repository->delete($id);
    }

    public function update(array $data, string $id): ?Atendimento
    {
        $atendimento = $this->repository->findById($id);

        if (!$atendimento) {
            throw new ModelNotFoundException("Não é possível atualizar. Atendimento não encontrado com o ID: $id");
        }

        //Verifica status e tenta converter o ENUM
        if (isset($data['status'])) {
            $validStatuses = AtendimentoStatus::toArray();
            if (!in_array($data['status'], $validStatuses)) {
                $validStatusesString = implode(', ', $validStatuses);
                throw new InvalidArgumentException("O status fornecido para o atendimento não é válido. Valores válidos são: $validStatusesString");
            }

            $data['status'] = AtendimentoStatus::byName($data['status']);
        }

        return $this->repository->update($data, $id);
    }


}
