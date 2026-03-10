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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams'); // Empresa associada ao fornecedor
            $table->string('name'); // Nome do fornecedor
            $table->integer('federalTaxNumber')->nullable(); // CPF ou CNPJ do fornecedor
            $table->string('email')->nullable(); // Email do fornecedor
            $table->string('phone')->nullable(); // Telefone do fornecedor
            
            $table->string('category')->nullable(); // Categoria do fornecedor, ex.: 'materiais', 'serviços', 'funcionários' etc.
            
            $table->string('personType')->nullable(); // Tipo de pessoa: 'fisica' ou 'juridica', ENUMS DO LARAVEL
            $table->string('tradeName')->nullable(); // Nome fantasia do fornecedor
            $table->string('taxRegime')->nullable(); // Regime tributário do fornecedor, ex.: 'simplesNacional', 'lucroPresumido', etc. ENUMS DO LARAVEL
            $table->string('stateTaxNumber')->nullable(); // Inscrição estadual do fornecedor
            
            $table->string('state')->nullable(); // Estado
            $table->string('codeCity')->nullable(); // Código do município, segundo a tabela de municípios do IBGE -> API IBGE
            $table->string('nameCity')->nullable(); // Nome do município -> API IBGE
            $table->string('district')->nullable(); // Bairro do endereço -> API IBGE
            $table->string('additionalInformation')->nullable(); // Complemento do endereço
            $table->string('street')->nullable(); // Logradouro do endereço -> API IBGE
            $table->string('number')->nullable()->default('S/N'); // Número do endereço
            $table->string('postalCode')->nullable(); // CEP -> API ViaCEP
            $table->string('country')->nullable(); // País -> API IBGE
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('file_provider', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('providers');
            $table->string('name'); // Nome do arquivo associado ao fornecedor
            $table->foreignId('file_type_id')->constrained('file_types'); // Tipo do arquivo associado ao fornecedor
            $table->string('url')->nullable(); // URL do arquivo associado ao fornecedor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
