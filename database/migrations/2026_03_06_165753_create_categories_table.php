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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams'); // Empresa associada à categoria
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // URL da imagem da categoria
            $table->string('icon')->nullable(); // URL do ícone da categoria
            $table->boolean('is_menu')->default(false); // Indica se a categoria é do cardápio
            $table->integer('order_menu')->nullable(); // Ordem da categoria, caso haja mais de uma categoria por empresa

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
