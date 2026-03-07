<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('slug')->unique(); // Slug da organização
            $table->string('image')->nullable(); // Imagem da organização
            $table->string('accountId')->nullable(); // ID da conta associada
            $table->string('tradeName')->nullable(); // Nome fantasia
            $table->bigInteger('federalTaxNumber')->nullable(); // CNPJ
            $table->enum('taxRegime', ['isento', 'microempreendedorIndividual', 'simplesNacional', 'lucroPresumido', 'lucroReal', 'none'])->nullable(); // Regime tributário

            $table->string('state')->nullable(); // Estado, ex.: SP, RJ, AC, padrão ISO 3166-2 ALFA 2.
            $table->string('codeCity')->nullable(); // Cód. do Município, segundo o Tabela de Municípios do IBGE
            $table->string('nameCity')->nullable(); // Nome do Município
            $table->string('district')->nullable(); // Bairro do Endereço
            $table->string('additionalInformation')->nullable(); // Complemento do Endereço
            $table->string('street')->nullable(); // Logradouro
            $table->string('number')->nullable()->default('S/N'); // Número do Endereço. Usar S/N para "sem número".
            $table->string('postalCode')->nullable(); // Cód. Endereço Postal (CEP)
            $table->string('country')->nullable(); // País, ex.: BRA, ARG, USA, padrão ISO 3166-1 ALFA-3.

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('company_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies'); // ID da empresa
            $table->string('file'); // Arquivo com certificado ICP-Brasil com extensão .pfx ou .p12
            $table->string('password'); // Senha do certificado ICP-Brasil
            $table->timestamps();
        });

        Schema::create('company_state_taxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->string('code'); // Código do Estado
            $table->enum('environmentType', ['none', 'production', 'test'])->nullable(); // Ambiente
            $table->string('taxNumber'); // Inscrição Estadual
            $table->enum('specialTaxRegime', ['automatico', 'nenhum', 'microempresaMunicipal', 'estimativa', 'sociedadeDeProfissionais', 'cooperativa', 'microempreendedorIndividual', 'microempresarioEmpresaPequenoPorte'])->nullable(); // Tipo do regime especial de tributação
            $table->integer('serie'); // Serie para a emissão NFe
            $table->bigInteger('number'); // Número para a emissão NFe
            $table->bigInteger('securityCredentialId')->nullable(); // Id do código de segurança do contribuinte
            $table->string('securityCredentialCode')->nullable(); // Código de segurança do contribuinte
            $table->enum('type', ['default', 'nFe', 'nFCe'])->nullable(); // Tipo de emissão
            $table->timestamps();
        });

        Schema::create('company_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });

        DB::table('companies')->insert([
            'name' => 'Razeltec',
            'slug' => 'razeltec',
            'tradeName' => 'Razeltec CoNsultoria e Soluções em TI LTDA',
            'federalTaxNumber' => 52268704000143, // CNPJ fictício
            'taxRegime' => 'simplesNacional',
            'state' => 'SP',
            'codeCity' => '3550308', // Código do município de São Paulo segundo o IBGE
            'nameCity' => 'São Paulo',
            'district' => 'Centro',
            'street' => 'Rua da Consolação',
            'number' => '1234',
            'postalCode' => '01301200',
            'country' => 'BRA', // Brasil
        ]);

        DB::table('company_user')->insert([
            'company_id' => 1, // ID da empresa Razeltec
            'user_id' => 1, // ID do usuário admin
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
        Schema::dropIfExists('company_certificates');
        Schema::dropIfExists('company_state_taxes');
        Schema::dropIfExists('company_user');
    }
};
