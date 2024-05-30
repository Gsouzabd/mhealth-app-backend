<?php

namespace App\Services;

use App\Models\Guia;
use App\Repositories\GuiaRepository;
use DOMDocument;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use SimpleXMLElement;

class GuiaService
{
    protected $repository;
    protected $loteService;

    public function __construct(GuiaRepository $repository, LoteService $loteService)
    {
        $this->repository = $repository;
        $this->loteService = $loteService;
    }

    public function getAll(array $filters = null): array
    {
        return $this->repository->getAll($filters);
    }

    public function findById(string $id): ?Guia
    {
        $guia = $this->repository->findById($id);

        if (!$guia) {
            throw new ModelNotFoundException("Guia não encontrado com o ID: $id");
        }
        return $guia;
    }

    public function create(array $data): Guia
    {
        $numeroLote = $data['lote_numero'] ?? null;
        $convenioId = $data['id_convenio'] ?? null;

        $data['valor_total'] = $data['valor'] ?? null;
        $data['tipo'] = $data['tipo_consulta'] ?? null;
        $data['numero'] = $numeroLote;

        if($numeroLote && $convenioId){
            $loteExistente = $this->loteService->findByNumero($numeroLote, $convenioId);

            if(!is_null($loteExistente)){
                $noLimiteDeGuias = $this->loteService->noLimiteDeGuias($numeroLote, $convenioId);

                dd($noLimiteDeGuias);
                if ($noLimiteDeGuias) {
                    $data['id_lote'] = $loteExistente->id;
                }else{
                    $data['numero'] = $this->loteService->proximoLote($convenioId);
                    $loteCriado = $this->loteService->create($data);
                    $data['id_lote'] = $loteCriado->id;
                }
            } else{
                $loteCriado = $this->loteService->create($data);
                $data['id_lote'] = $loteCriado->id;
            }
        }else{
            $data['numero'] = $this->loteService->proximoLote($convenioId);
            $loteCriado = $this->loteService->create($data);
            $data['id_lote'] = $loteCriado->id;
        }

        $data['lote_numero'] = $data['numero'];

        $guia = $this->repository->create($data);
        $guia->load('lote');

        return $guia;
    }

    public function delete(string $id): void
    {
        $guia = $this->repository->findById($id);

        if (!$guia) {
            throw new ModelNotFoundException("Não é possível excluir. Guia não encontrado com o ID: $id");
        }

        $this->repository->delete($id);
    }

    public function update(array $data, string $id): ?Guia
    {
        $guia = $this->repository->findById($id);

        if (!$guia) {
            throw new ModelNotFoundException("Não é possível atualizar. Guia não encontrado com o ID: $id");
        }

        return $this->repository->update($data, $id);
    }



    /**
     * Gera o XML para uma guia específica.
     *
     * @param string $id ID da guia.
     * @return string XML da guia.
     */
    public function gerarXmlGuia(string $id): string
    {
        $guia = $this->findById($id);

        if (!$guia) {
            throw new ModelNotFoundException("Guia não encontrada com o ID: $id");
        }



    }
}
