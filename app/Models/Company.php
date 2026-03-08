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

    protected $fillable = [
        'name',
        'cnpj',
        'stateRegistration',
        'municipalRegistration',
        'email',
        'phone',
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

    // Atributos adicionais para o modelo Company
    protected $casts = [
        'is_menu' => 'boolean', // Indica se a empresa é do cardápio
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relacionamentos

    // Uma empresa pode ter muitos usuários (relação muitos-para-muitos)
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'company_user');
    }

    // Uma empresa pode ter muitos certificados
    public function certificates(): HasMany
    {
        return $this->hasMany(CompanyCertificate::class);
    }

    // Uma empresa pode ter muitos impostos estaduais
    public function stateTaxes(): HasMany
    {
        return $this->hasMany(CompanyStateTax::class);
    }

    // Uma empresa pode ter muitos tipos de arquivos
    public function filesTypes(): HasMany
    {
        return $this->hasMany(FileType::class);
    }

    // Uma empresa pode ter muitos clientes
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    // Uma empresa pode ter muitos fornecedores
    public function providers(): HasMany
    {
        return $this->hasMany(Provider::class);
    }

    // Uma empresa pode ter muitas categorias
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    // Uma empresa pode ter muitos produtos
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
