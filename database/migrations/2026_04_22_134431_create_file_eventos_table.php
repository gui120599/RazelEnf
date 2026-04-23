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
        Schema::create('file_eventos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('evento_adverso_id')->constrained('eventos_adversos')->onDelete('cascade'); // Relacionamento com o evento adverso
            $table->string('file_path'); // Caminho do arquivo armazenado
            $table->string('original_name'); // Nome original do arquivo
            $table->string('mime_type'); // Tipo MIME do arquivo
            $table->unsignedBigInteger('size'); // Tamanho do arquivo em bytes
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_eventos');
    }
};
