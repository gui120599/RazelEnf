<?php

namespace App\Enums;

enum TypeFileEnum: string
{
    case DOCUMENTO = 'documento';
    case IMAGEM = 'imagem';

    public function label(): string
    {
        return match ($this) {
            self::DOCUMENTO => 'Documento',
            self::IMAGEM => 'Imagem',
        };
    }
}
