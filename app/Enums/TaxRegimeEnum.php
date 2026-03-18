<?php

namespace App\Enums;

enum TaxRegimeEnum: string
{
    case ISENTO = 'isento';
    case MICROEMPREENDEDOR_INDIVIDUAL = 'microempreendedorIndividual';
    case SIMPLES_NACIONAL = 'simplesNacional';
    case LUCRO_PRESUMIDO = 'lucroPresumido';
    case LUCRO_REAL = 'lucroReal';
    case NONE = 'none';

    public function label(): string
    {
        return match ($this) {
            self::ISENTO => 'Isento',
            self::MICROEMPREENDEDOR_INDIVIDUAL => 'Microempreendedor Individual',
            self::SIMPLES_NACIONAL => 'Simples Nacional',
            self::LUCRO_PRESUMIDO => 'Lucro Presumido',
            self::LUCRO_REAL => 'Lucro Real',
            self::NONE => 'Nenhum',
        };
    }

    public static function options(): array
    {
        return array_combine(
            array_map(fn (self $item) => $item->value, self::cases()),
            array_map(fn (self $item) => $item->label(), self::cases()),
        );
    }
}