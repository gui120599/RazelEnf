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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams'); // Empresa associada ao produto
            $table->string('name'); // Nome do produto
            $table->string('description'); // Descrição do produto
            $table->boolean('is_menu')->default(false); // Indica se o produto é do cardápio
            $table->integer('order_menu')->nullable(); // Ordem do produto no cardápio
            $table->foreignId('category_id')->constrained('categories'); // Categoria do produto
            $table->string('type')->nullable(); // Ex.: 'produto', 'serviço', 'combo' ENUMS DO LARAVEL
            $table->boolean('inventoryControl')->default(false); // Indica se o produto tem controle de estoque
            $table->string('seasoning')->nullable(); // Ex: 'Muçarela, tomate, orégano'
            $table->string('image')->nullable(); // Imagem do produto
            $table->string('unit')->nullable(); // Unidade de medida, ex.: 'un', 'kg', 'l' ENUMS DO LARAVEL
            $table->decimal('priceSale',10,2)->nullable(); // Preço de venda
            $table->string('ncm')->nullable(); // Nomenclatura Comum do Mercosul
            $table->string('cest')->nullable()->default('0000000'); // Código Especificador da Substituição Tributária
            $table->string('ean')->nullable()->default('SEM GTIN'); // Código de Barras (GTIN)
            $table->string('codigo_beneficio_fiscal_uf')->nullable(); // Código de benefício fiscal do estado para o produto
            $table->string('cfop')->nullable(); // Código Fiscal de Operações e Prestações
            $table->string('csosn')->nullable(); // Código de Situação da Operação no Simples Nacional
            $table->string('origin')->nullable(); // Origem do produto
            $table->string('cst')->nullable(); // Código de Situação Tributária ICMS
            $table->decimal('icmsPercentage',10,2)->nullable(); // Alíquota do ICMS
            $table->decimal('cofinsPercentage',10,2)->nullable(); // Alíquota do COFINS
            $table->decimal('pisPercentage',10,2)->nullable(); // Alíquota do PIS
            $table->decimal('reductionIcmsPercentage',10,2)->nullable(); // Alíquota de redução do ICMS
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products'); // Produto associado à imagem
            $table->string('image'); // URL da imagem do produto
            $table->string('order')->nullable(); // Ordem da imagem, caso haja mais de uma imagem por produto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
