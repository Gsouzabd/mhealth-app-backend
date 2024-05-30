<?php

namespace App\Strategies;

use App\Models\Guia;
use Illuminate\Support\Collection;

interface TissXmlStrategy
{
    public function gerar(Collection $guias, int $lote): string;
}
