<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamCertificate extends Model
{
    protected $fillable = [
        'team_id',
        'file',
        'password',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
