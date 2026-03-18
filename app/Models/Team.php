<?php

namespace App\Models;

use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model implements HasAvatar
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'accountId',
        'tradeName',
        'federalTaxNumber',
        'taxRegime',
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

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->image
            ? Storage::url($this->image)
            : null;
    }

    public function members()
    {
        return $this->belongsToMany(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function certificates()
    {
        return $this->hasMany(TeamCertificate::class);
    }

    public function stateTaxes()
    {
        return $this->hasMany(TeamStateTax::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
