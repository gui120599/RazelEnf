<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'team_id',
        'name',
        'description',
        'is_menu',
        'order_menu',
        'category_id',
        'type',
        'inventoryControl',
        'seasoning',
        'image',
        'unit',
        'priceSale',
        'ncm',
        'cest',
        'ean',
        'codigo_beneficio_fiscal_uf',
        'cfop',
        'csosn',
        'origin',
        'cst',
        'icmsPercentage',
        'cofinsPercentage',
        'pisPercentage',
        'reductionIcmsPercentage',
    ];

    protected $casts = [
        'is_menu'                  => 'boolean',
        'order_menu'               => 'integer',
        'inventoryControl'         => 'boolean',
        'priceSale'                => 'decimal:2',
        'icmsPercentage'           => 'decimal:2',
        'cofinsPercentage'         => 'decimal:2',
        'pisPercentage'            => 'decimal:2',
        'reductionIcmsPercentage'  => 'decimal:2',

        // Enums sugeridos (descomente após criar os Enums)
        // 'type' => ProductType::class,
        // 'unit' => ProductUnit::class,
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
}