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
        Schema::create('descricao_classificacao_eventos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('classificacao_evento_id')->constrained('classificacao_eventos'); // Classificação do evento adverso
            $table->string('descricao'); // Descrição detalhada da classificação do evento adverso
            $table->integer('order')->nullable(); // Campo para definir a ordem das descrições

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descricao_classificacao_eventos');
    }
};
