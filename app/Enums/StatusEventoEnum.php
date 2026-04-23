<?php

namespace App\Enums;

enum StatusEventoEnum: string
{
    case ABERTO = 'aberto';
    case ANALISE = 'analise';
    case CONCLUIDO = 'concluido';

    public function label(): string
    {
        return match($this) {
            self::ABERTO => 'Aberto',
            self::ANALISE => 'Em análise',
            self::CONCLUIDO => 'Concluído',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::ABERTO => 'gray',
            self::ANALISE => 'warning',
            self::CONCLUIDO => 'success',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }
}
