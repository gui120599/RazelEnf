<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'accountId',
        'tradeName',
        'federalTaxNumber',
        'taxRegime',
        'state',
        'city_code',
        'city_name',
        'district',
        'additionalInformation',
        'street',
        'number',
        'postalCode',
        'country',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'federalTaxNumber' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The attributes that should have default values.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'number' => 'S/N',
    ];

    /**
     * Get the tax regime values.
     *
     * @return array<string>
     */
    public static function getTaxRegimes(): array
    {
        return [
            'isento',
            'microempreendedorIndividual',
            'simplesNacional',
            'lucroPresumido',
            'lucroReal',
            'none',
        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Chave estrengeira em CompanyCertificate
     * @return HasMany
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(CompanyCertificate::class);
    }

    /**
     * Chave estrangeira em CompanyStateTax
     * @return HasMany
     */
    public function stateTaxes(): HasMany
    {
        return $this->hasMany(CompanyStateTax::class);
    }
}
