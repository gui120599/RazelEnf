<?php

namespace App\Enums;

enum SpecialTaxRegimeEnum: string
{
    case AUTOMATICO = 'automatico';
    case NENHUM = 'nenhum';
    case MICROEMPRESA_MUNICIPAL = 'microempresaMunicipal';
    case ESTIMATIVA = 'estimativa';
    case SOCIEDADE_DE_PROFISSIONAIS = 'sociedadeDeProfissionais';
    case COOPERATIVA = 'cooperativa';
    case MICROEMPREENDEDOR_INDIVIDUAL = 'microempreendedorIndividual';
    case MICROEMPRESARIO_EMPRESA_PEQUENO_PORTE = 'microempresarioEmpresaPequenoPorte';

    public function label(): string
    {
        return match ($this) {
            self::AUTOMATICO => 'Automático',
            self::NENHUM => 'Nenhum',
            self::MICROEMPRESA_MUNICIPAL => 'Microempresa Municipal',
            self::ESTIMATIVA => 'Estimativa',
            self::SOCIEDADE_DE_PROFISSIONAIS => 'Sociedade de Profissionais',
            self::COOPERATIVA => 'Cooperativa',
            self::MICROEMPREENDEDOR_INDIVIDUAL => 'Microempreendedor Individual',
            self::MICROEMPRESARIO_EMPRESA_PEQUENO_PORTE => 'Microempresário e Empresa de Pequeno Porte',
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
