<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
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
}
