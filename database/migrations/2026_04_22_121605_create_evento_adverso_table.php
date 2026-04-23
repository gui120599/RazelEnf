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
        Schema::create('eventos_adversos', function (Blueprint $table) {
            $table->id();

             // 🔑 Multi-tenant
            $table->foreignId('team_id')->constrained('teams');

            // 📄 Identificação
            $table->string('codigo')->unique();

            // 📅 Dados do evento
            $table->date('data_evento');
            $table->time('hora_evento')->nullable();
            $table->string('periodo_dia_evento')->nullable(); //Enum: 'manhã', 'tarde', 'noite'

            // 🏥 Contexto
            $table->foreignId('setor_notificador_id')->constrained('setores')->nullable(); // Setor do notificador do evento adverso
            $table->foreignId('setor_evento_id')->constrained('setores')->nullable(); // Setor onde ocorreu o evento adverso
            $table->foreignId('classificacao_evento_id')->constrained('classificacao_eventos'); // Classificação do evento adverso
            $table->foreignId('descricao_classificacao_evento_id')->constrained('descricao_classificacao_eventos'); // Descrição detalhada da classificação do evento adverso
            $table->text('descricao_evento')->nullable(); // Descrição detalhada do evento adverso

            // 👤 Envolvidos
            $table->string('tipo_envolvido')->nullable(); //Enum: 'paciente', 'visitante', 'colaborador', 'outro'
            $table->string('nome_envolvido')->nullable(); // Nome do paciente envolvido no evento adverso
            $table->date('data_nascimento_envolvido')->nullable(); // Data de nascimento do paciente envolvido no evento adverso

            // 👤 Paciente
            $table->string('prontuario_paciente')->nullable(); // Prontuário do paciente envolvido no evento adverso
            $table->string('diagnostico_paciente')->nullable(); // Diagnóstico do paciente envolvido no evento adverso

            // ⚠️ Ação Imediata
            $table->string('descricao_acao_imediata')->nullable(); // Descrição da ação imediata tomada após o evento adverso

            // ⚠️ Classificação
            $table->string('grau_dano')->nullable(); //Enum: 'leve', 'moderado', 'grave', 'letal'

            // 📝 Descrição
            $table->text('analise_causa')->nullable();
            $table->text('plano_acao')->nullable();

            // 🔄 Controle
            $table->enum('status', ['aberto', 'analise', 'concluido'])->default('aberto');

            // 🌐 Segurança / auditoria
            $table->ipAddress('ip')->nullable();

            // 👤 (opcional - se quiser identificar usuário)
            $table->string('nome_notificador')->nullable(); // Nome do notificador do evento adverso
            $table->string('email_notificador')->nullable(); // Email do notificador do evento adverso
            $table->string('telefone_notificador')->nullable(); // Telefone do notificador do evento adverso
            $table->foreignId('notificador_id')->nullable()->constrained('users')->nullOnDelete();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_adversos');
    }
};
