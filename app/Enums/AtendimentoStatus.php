<?php

namespace App\Enums;

use ValueError;

enum AtendimentoStatus: string
{
    case m = 'marcado';
    case ee = 'em espera';
    case ea = 'em andamento';
    case r = 'realizado';
    case f = 'falta';
    case d = 'desmarcado';

    public static function toArray(): array
    {
        $statusArray = [];
        foreach (self::cases() as $status) {
            $statusArray[] = $status->value;
        }
        return $statusArray;
    }

    public static function byName(string $nomeStatus): string
    {
        foreach (self::cases() as $status) {
            if ($nomeStatus === $status->name) {
                return $status->value;
            }
        }
        throw new ValueError("$status is not valid");
    }

    public static function byValue(string $valueStatus): string
    {
        foreach (self::cases() as $status) {
            if ($valueStatus === $status->value) {
                return $status->name;
            }
        }
        throw new ValueError("$status is not valid");
    }

}
