<?php

namespace App\Enums;

enum PeriodoDiaEventoEnum: string
{
    case MANHA = 'manha';
    case TARDE = 'tarde';
    case NOITE = 'noite';

    public function label(): string
    {
        return match($this) {
            self::MANHA => 'Manhã',
            self::TARDE => 'Tarde',
            self::NOITE => 'Noite',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }
}
