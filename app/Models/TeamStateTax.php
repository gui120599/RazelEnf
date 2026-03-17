<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamStateTax extends Model
{
    protected $fillable = [
        'team_id',
        'code',
        'environmentType',
        'taxNumber',
        'specialTaxRegime',
        'serie',
        'number',
        'securityCredentialId',
        'securityCredentialCode',
        'type',
    ];

    protected $casts = [
        'serie'                => 'integer',
        'number'               => 'integer',
        'securityCredentialId' => 'integer',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
