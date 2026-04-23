<?php

namespace App\Enums;

enum GrauDanoEnum: string
{
    case LEVE = 'leve';
    case MODERADO = 'moderado';
    case GRAVE = 'grave';
    case LETAL = 'letal';

    public function label(): string
    {
        return match($this) {
            self::LEVE => 'Leve',
            self::MODERADO => 'Moderado',
            self::GRAVE => 'Grave',
            self::LETAL => 'Letal',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::LEVE => 'success',
            self::MODERADO => 'warning',
            self::GRAVE => 'danger',
            self::LETAL => 'danger',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }
}
