<?php

use App\Enums\AtendimentoStatus;
use App\Enums\MarcacaoTipoRecorrencia;

if(!function_exists('getTipoRecorrencia')) {
    function getTipoRecorrencia(string $by, string $tipoRecorrencia): string
    {
        if($by == 'value'){
            return MarcacaoTipoRecorrencia::byValue($tipoRecorrencia);
        }elseif ($by == 'name'){
            return MarcacaoTipoRecorrencia::byName($tipoRecorrencia);
        }
        return "método by{$by} não encontrado";
    }
}


if(!function_exists('getStatus')) {
    function getAtendimentoStatus(string $by, string $status): string
    {
        if($by == 'value'){
            return AtendimentoStatus::byValue($status);
        }elseif ($by == 'name'){
            return AtendimentoStatus::byName($status);
        }
        return "método by{$by} não encontrado";
    }
}


