<?php

namespace App\Services;

use App\Models\Lote;
use App\Repositories\LoteRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Exception;
use Ramsey\Uuid\Type\Integer;

class LoteService
{
    protected $repository;

    public function __construct(LoteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $filters = null): array
    {
        return $this->repository->getAll($filters);
    }

    public function findById(string $id): ?Lote
    {
        $lote = $this->repository->findById($id);

        if (!$lote) {
            throw new ModelNotFoundException("Lote não encontrado com o ID: $id");
        }
        return $lote;
    }

    public function create(array $data): Lote
    {
        $numeroLote = $data['numero'] ?? null;
        $convenioId = $data['id_convenio'] ?? null;

        if ($numeroLote !== null && $convenioId !== null) {
            if ($this->loteExiste($numeroLote, $convenioId)) {
                throw ValidationException::withMessages(['Ja existe um lote com este numero para o convenio fornecido.']);
            }
        }
        // Se tudo estiver OK, cria o lote
        return $this->repository->create($data);
    }


    public function delete(string $id): void
    {
        $lote = $this->repository->findById($id);

        if (!$lote) {
            throw new ModelNotFoundException("Não é possível excluir. Lote não encontrado com o ID: $id");
        }

        $this->repository->delete($id);
    }

    public function update(array $data, string $id): ?Lote
    {
        $lote = $this->repository->findById($id);

        if (!$lote) {
            throw new ModelNotFoundException("Não é possível atualizar. Lote não encontrado com o ID: $id");
        }

        return $this->repository->update($data, $id);
    }

    protected function loteExiste(string $numeroLote, int $convenioId): bool
    {
        return !is_null($this->repository->findByNumero($numeroLote, $convenioId));
    }

    public function findByNumero($numeroLote, $convenioId): ?Lote
    {
        return $this->repository->findByNumero($numeroLote, $convenioId);
    }

    public function findByConvenio($convenioId): array
    {
        return $this->repository->findByConvenio($convenioId);
    }

    public function numeroDeGuias($numeroLote, $convenioId): int
    {
        $lote = $this->findByNumero($numeroLote, $convenioId);
        if (!$lote) {
            throw new ModelNotFoundException("Lote não encontrado do convênio $convenioId com o Número: $numeroLote");
        }
        return $lote->guias()->count();
    }

    public function noLimiteDeGuias($numeroLote, $convenioId): bool
    {
        $lote = $this->findByNumero($numeroLote, $convenioId);
        if (!$lote) {
            throw new ModelNotFoundException("Lote não encontrado do convênio $convenioId com o Número: $numeroLote");
        }
        $convenio = $lote->convenio;
        $numeroMaximo = $convenio->maxSessoesTiss;

        return $this->numeroDeGuias($numeroLote, $convenioId) < $numeroMaximo;
    }

    public function proximoLote($convenioId): int
    {
        $lotes = $this->findByConvenio($convenioId);

        return end($lotes)['numero'] + 1;
    }

}
