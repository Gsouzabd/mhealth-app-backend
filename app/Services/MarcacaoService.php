<?php

namespace App\Services;

use App\Models\Marcacao;
use App\Repositories\AtendimentoRepository;
use App\Repositories\MarcacaoRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MarcacaoService
{
    protected $repository;
    protected $atendimentoService;

    public function __construct(MarcacaoRepository $repository, AtendimentoService $atendimentoService)
    {
        $this->repository = $repository;
        $this->atendimentoService = $atendimentoService;
    }

    public function getAll(array $filters = null): array
    {
        return $this->repository->getAll($filters);
    }

    public function findById(string $id): ?Marcacao
    {
        $marcacao = $this->repository->findById($id);

        if (!$marcacao) {
            throw new ModelNotFoundException("Marcacao não encontrado com o ID: $id");
        }
        return $marcacao;
    }

    public function create(array $data): ?Marcacao
    {
        $data['tipoRecorrencia'] = $data['tipoRecorrencia'] ? getTipoRecorrencia('value', $data['tipoRecorrencia']) : null;

        $marcacao = $this->repository->create($data);

        if($marcacao){
            $marcacao->horario = $data['horario'];
            if(!$data['recorrencia']) {
                $data = [
                    'id_marcacao' => $marcacao->id,
                    'data' => $marcacao->data_inicial,
                    'status' => getAtendimentoStatus('value', 'marcado'),
                    'recorrente' => false,
                    'horario' => $marcacao->horario,
                    'duracao' => $marcacao->duracao,
                ];
                $this->atendimentoService->create($data);

            }else{
                $vezes = $data['vezesRecorrencia'];

                if($data['tipoRecorrencia'] == 's'){ // semanal
                    $semanas = 1;
                }
                if($data['tipoRecorrencia'] == 'q'){ // quinzenal
                    $semanas = 2;
                }
                if($data['tipoRecorrencia'] == 'm'){ //mensal
                    $semanas = 4;
                }

                $this->atendimentoService->createAtendimentosRecorrente($vezes, $marcacao, $semanas);
            }
        }
        $marcacao->load('atendimentos');
        return $marcacao;
    }

    public function delete(string $id): void
    {
        $marcacao = $this->repository->findById($id);

        if (!$marcacao) {
            throw new ModelNotFoundException("Não é possível excluir. Marcacao não encontrado com o ID: $id");
        }

        $this->repository->delete($id);
    }

    public function update(array $data, string $id): ?Marcacao
    {
        $marcacao = $this->repository->findById($id);

        if (!$marcacao) {
            throw new ModelNotFoundException("Não é possível atualizar. Marcacao não encontrado com o ID: $id");
        }

        return $this->repository->update($data, $id);
    }


    public function getAtendimentos(string $idMarcacao)
    {
        $marcacao = $this->repository->findById($idMarcacao);
        if (!$marcacao) {
            throw new ModelNotFoundException("Marcação não encontrado com o ID: $idMarcacao");
        }

        return $marcacao->atendimentos;
    }


    public function getAtendimentoById(string $idMarcacao, string $idAtendimento)
    {
        $marcacao = $this->repository->findById($idMarcacao);

        if (!$marcacao) {
            throw new ModelNotFoundException("Marcação não encontrada com o ID: $idMarcacao");
        }

        $atendimento = $marcacao->atendimentos->firstWhere('id', $idAtendimento);

        if (!$atendimento) {
            throw new ModelNotFoundException("Atendimento não encontrado com o ID: $idAtendimento na marcação de ID: $idMarcacao");
        }

        return $atendimento;
    }
}
