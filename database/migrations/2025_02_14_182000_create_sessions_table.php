<?php

/**********************************************************************************
// Migration - Create Sessions Table (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'sessions' no banco 
//              de dados. Esta tabela armazena informações sobre as sessões 
//              de usuários.
// 
// Tipo:        Migration
//
**********************************************************************************/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa a migration para criar a tabela 'sessions'.
     * 
     * Este método cria a tabela que armazena as sessões de usuários, 
     * incluindo o ID da sessão, o ID do usuário associado, o endereço 
     * IP, o agente do usuário, o payload da sessão e o tempo da última 
     * atividade registrada.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table): void {
            $table->string('id')->primary();  
            $table->foreignId('user_id')->nullable()->index(); 
            $table->string('ip_address', 45)->nullable();  
            $table->text('user_agent')->nullable(); 
            $table->text('payload');  
            $table->integer('last_activity')->index();  
        });
    }

    /**
     * Reverte a criação da tabela 'sessions'.
     * 
     * Este método é responsável por excluir a tabela 'sessions' caso a migration 
     * seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
