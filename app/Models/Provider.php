<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'federalTaxNumber',
        'email',
        'phone',
        'category',
        'personType',
        'tradeName',
        'taxRegime',
        'stateTaxNumber',
        'state',
        'codeCity',
        'nameCity',
        'district',
        'additionalInformation',
        'street',
        'number',
        'postalCode',
        'country',
    ];

    protected $casts = [
        'federalTaxNumber' => 'integer',
    ];

    // Enums sugeridos (Laravel 9+)
    // 'personType'  => PersonType::class,
    // 'taxRegime'   => TaxRegime::class,

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(FileProvider::class);
    }
}