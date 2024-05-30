<?php

namespace App\Services;

use App\Strategies\TissXml3_02_00;
use App\Strategies\TissXml3_02_01;
use App\Strategies\TissXml3_03_01;
use App\Strategies\TissXml3_03_02;
use App\Strategies\TissXml3_03_03;
use App\Strategies\TissXml3_04_00;
use App\Strategies\TissXml3_04_01;
use App\Strategies\TissXml3_05_00;
use App\Strategies\TissXml4_00_00;
use App\Strategies\TissXml4_00_01;
use App\Strategies\TissXml4_01_00;
use App\Strategies\TissXmlStrategy;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class TissXmlService.
 */
class TissXmlService
{
    protected $loteService;
    protected $convenioService;

    protected $strategies = [
        "4.01.00" => TissXml4_01_00::class,
        "4.00.01" => TissXml4_00_01::class,
        "4.00.00" => TissXml4_00_00::class,
        "3.05.00" => TissXml3_05_00::class,
        "3.04.01" => TissXml3_04_01::class,
        "3.04.00" => TissXml3_04_00::class,
        "3.03.03" => TissXml3_03_03::class,
        "3.03.02" => TissXml3_03_02::class,
        "3.03.01" => TissXml3_03_01::class,
        "3.02.01" => TissXml3_02_01::class,
        "3.02.00" => TissXml3_02_00::class
    ];

    public function __construct(LoteService $loteService, ConvenioService $convenioService)
    {
        $this->loteService = $loteService;
        $this->convenioService = $convenioService;
    }

    public function getStrategy($versao) : TissXmlStrategy
    {
        if(!array_key_exists($versao, $this->strategies)){
            throw new NotFoundHttpException("Versão XML inválida");
        }
        $strategyClass = $this->strategies[$versao];
        return new $strategyClass();
    }

    public function gerarXml($numeroLote, $convenioId): string {
        $lote = $this->loteService->findByNumero($numeroLote,$convenioId);
        if (!$lote) {
            throw new ModelNotFoundException("Não foi possível localizar um lote com número $numeroLote do convênio $convenioId");
        }

        $convenio = $this->convenioService->findById($convenioId);
        $versao = $convenio->versaoxml;

        $strategy = $this->getStrategy($versao);

        $guias = $lote->guias;

        return $strategy->gerar($guias, $numeroLote);
    }


}
