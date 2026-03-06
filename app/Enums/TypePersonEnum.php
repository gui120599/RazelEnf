<?php

namespace App\Enums;

enum TypePersonEnum: string
{
    case PF = 'pf';
    case PJ = 'pj';

    public function label(): string
    {
        return match ($this) {
            self::PF => 'Pessoa Física',
            self::PJ => 'Pessoa Jurídica',
        };
    }
}
