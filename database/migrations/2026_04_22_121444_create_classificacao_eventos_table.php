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
        Schema::create('classificacao_eventos', function (Blueprint $table) {
            $table->id();
            
            // 🔑 Multi-tenant
            $table->foreignId('team_id')->constrained('teams');
            
            $table->string('name'); // Nome da classificação do evento adverso
            $table->text('description')->nullable(); // Descrição detalhada da classificação do evento adverso
            $table->boolean('listar_no_formulario')->default(true); // Indica se essa classificação deve ser listada no formulário de cadastro de evento adverso

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classificacao_eventos');
    }
};
