<?php

namespace App\Enums;

enum TipoEnvolvidoEnum: string
{
    case PACIENTE = 'paciente';
    case VISITANTE = 'visitante';
    case COLABORADOR = 'colaborador';
    case OUTRO = 'outro';

    public function label(): string
    {
        return match($this) {
            self::PACIENTE => 'Paciente',
            self::VISITANTE => 'Visitante',
            self::COLABORADOR => 'Colaborador',
            self::OUTRO => 'Outro',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }
}
