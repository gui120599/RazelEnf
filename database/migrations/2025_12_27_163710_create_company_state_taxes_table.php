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
        Schema::create('company_state_taxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->string('code'); // Código do Estado
            $table->enum('environment_type', ['none', 'production', 'test'])->nullable(); // Ambiente
            $table->string('tax_number'); // Inscrição Estadual
            $table->enum('special_tax_regime', ['automatico', 'nenhum', 'microempresaMunicipal', 'estimativa', 'sociedadeDeProfissionais', 'cooperativa', 'microempreendedorIndividual', 'microempresarioEmpresaPequenoPorte'])->nullable(); // Tipo do regime especial de tributação
            $table->integer('serie'); // Serie para a emissão NFe
            $table->bigInteger('number'); // Número para a emissão NFe
            $table->integer('security_credential_id')->nullable(); // Id do código de segurança do contribuinte
            $table->string('security_credential_code')->nullable(); // Código de segurança do contribuinte
            $table->enum('type', ['default', 'nFe', 'nFCe'])->nullable(); // Tipo de emissão
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_state_taxes');
    }
};
