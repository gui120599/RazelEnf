<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome da organização
            $table->string('image')->nullable(); // Imagem da organização
            $table->string('accountId')->nullable(); // ID da conta associada
            $table->string('tradeName')->nullable(); // Nome fantasia
            $table->integer('federalTaxNumber')->nullable(); // CNPJ
            $table->enum('taxRegime', ['isento', 'microempreendedorIndividual','simplesNacional','lucroPresumido','lucroReal','none'])->nullable(); // Regime tributário
            $table->string('state')->nullable(); // Estado, ex.: SP, RJ, AC, padrão ISO 3166-2 ALFA 2.
            $table->string('city_code')->nullable(); // Cód. do Município, segundo o Tabela de Municípios do IBGE
            $table->string('city_name')->nullable(); // Nome do Município
            $table->string('district')->nullable(); // Bairro do Endereço
            $table->string('additionalInformation')->nullable(); // Complemento do Endereço
            $table->string('street')->nullable(); // Logradouro
            $table->string('number')->nullable()->default('S/N'); // Número do Endereço. Usar S/N para "sem número".
            $table->string('postalCode')->nullable(); // Cód. Endereço Postal (CEP)
            $table->string('country')->nullable(); // País, ex.: BRA, ARG, USA, padrão ISO 3166-1 ALFA-3.
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
