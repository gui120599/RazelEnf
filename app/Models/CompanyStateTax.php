<?php

namespace App\Models;

use COM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyStateTax extends Model
{
    use HasFactory;

    protected $table = 'company_state_taxes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'code',
        'environment_type',
        'tax_number',
        'special_tax_regime',
        'serie',
        'number',
        'security_credential_id',
        'security_credential_code',
        'type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'serie' => 'integer',
        'number' => 'integer',
        'security_credential_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the environment types.
     *
     * @return array<string>
     */
    public static function getEnvironmentTypes(): array
    {
        return ['none', 'production', 'test'];
    }

    /**
     * Get the special tax regimes.
     *
     * @return array<string>
     */
    public static function getSpecialTaxRegimes(): array
    {
        return ['automatico', 'nenhum', 'microempresaMunicipal', 'estimativa', 'sociedadeDeProfissionais', 'cooperativa', 'microempreendedorIndividual', 'microempresarioEmpresaPequenoPorte'];
    }

    /**
     * Get the emission types.
     *
     * @return array<string>
     */
    public static function getEmissionTypes(): array
    {
        return ['default', 'nFe', 'nFCe'];
    }

    /**
     * Chave estrangeira em CompanyStateTax
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
