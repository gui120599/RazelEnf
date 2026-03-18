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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams'); // Empresa associada ao cliente
            $table->string('name'); // Nome do cliente
            $table->string('federalTaxNumber')->nullable(); // CPF ou CNPJ do cliente
            $table->string('email')->nullable(); // Email do cliente
            $table->string('phone')->nullable(); // Telefone do cliente
            
            $table->string('personType')->nullable(); // Tipo de pessoa: 'fisica' ou 'juridica'
            $table->string('tradeName')->nullable(); // Nome fantasia do cliente
            $table->string('taxRegime')->nullable(); // Regime tributário do cliente, ex.: 'simplesNacional', 'lucroPresumido', etc.
            $table->string('stateTaxNumber')->nullable(); // Inscrição estadual do cliente
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('client_user', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('user_id')->constrained('users');
        });

        Schema::create('client_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients'); // Cliente associado ao endereço
            $table->string('state')->nullable(); // Estado
            $table->string('codeCity')->nullable(); // Código do município, segundo a tabela de municípios do IBGE
            $table->string('nameCity')->nullable(); // Nome do município
            $table->string('district')->nullable(); // Bairro
            $table->string('additionalInformation')->nullable(); // Complemento do endereço
            $table->string('street')->nullable(); // Logradouro
            $table->string('number')->nullable()->default('S/N'); // Número do endereço
            $table->string('postalCode')->nullable(); // CEP
            $table->string('country')->nullable(); // País
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('file_client', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients');
            $table->string('name'); // Nome do arquivo associado ao cliente
            $table->foreignId('file_type_id')->constrained('file_types'); // Tipo do arquivo associado ao cliente
            $table->string('url')->nullable(); // URL do arquivo associado ao cliente
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
        Schema::dropIfExists('client_user');
        Schema::dropIfExists('client_addresses');
    }
};
