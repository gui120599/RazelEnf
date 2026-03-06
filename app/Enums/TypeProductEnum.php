<?php

namespace App\Enums;

enum TypeProductEnum: string
{
    case PRODUZIDO = 'produzido';
    case REVENDA = 'revenda';
    case INSUMO = 'insumo';
    case CONSUMO_INTERNO = 'consumo_interno';
    case SERVICO = 'servico';


    public function label(): string
    {
        return match($this) {
            self::PRODUZIDO => 'Produto Produzido',
            self::REVENDA => 'Produto Revenda',
            self::INSUMO => 'Insumo',
            self::CONSUMO_INTERNO => 'Consumo Interno',
            self::SERVICO => 'Serviço',
        };
    }

    public function controlaEstoqueDireto(): bool
    {
        return match($this) {
            self::PRODUZIDO => false,
            default => true,
        };
    }
}
