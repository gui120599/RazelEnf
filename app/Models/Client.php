<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'team_id',
        'name',
        'federalTaxNumber',
        'email',
        'phone',
        'personType',
        'tradeName',
        'taxRegime',
        'stateTaxNumber',
    ];

    // Enums sugeridos (Laravel 9+)
    // 'personType'  => PersonType::class,
    // 'taxRegime'   => TaxRegime::class,


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'client_user');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
