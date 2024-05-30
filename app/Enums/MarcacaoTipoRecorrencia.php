<?php

namespace App\Enums;

use ValueError;

enum MarcacaoTipoRecorrencia: string
{
    case s = 'semanal';
    case q = 'quinzenal';
    case m = 'mensal';

    public static function byName(string $nomeTipoRecorrencia): string
    {
        foreach (self::cases() as $tipoRecorrencia) {
            if ($nomeTipoRecorrencia === $tipoRecorrencia->name) {
                return $tipoRecorrencia->value;
            }
        }
        throw new ValueError("$tipoRecorrencia is nots valid");
    }

    public static function byValue(string $valueTipoRecorrencia): string
    {
        foreach (self::cases() as $tipoRecorrencia) {
            if ($valueTipoRecorrencia === $tipoRecorrencia->value) {
                return $tipoRecorrencia->name;
            }
        }
        throw new ValueError("$tipoRecorrencia is not valid");
    }
}
