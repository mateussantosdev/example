<?php

/**********************************************************************************
// Migration - Create Password Reset Tokens Table (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'password_reset_tokens' 
//              no banco de dados, que armazena os tokens para a redefinição de senha 
//              dos usuários.
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
     * Executa a migration para criar a tabela 'password_reset_tokens'.
     * 
     * Este método é responsável por criar a tabela que armazena os tokens usados
     * para redefinir as senhas dos usuários. A tabela inclui o email do usuário, 
     * o token gerado e a data de criação do token.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('password_reset_tokens', function (Blueprint $table): void {
            $table->string('email')->primary();  
            $table->string('token');  
            $table->timestamp('created_at')->nullable(); 
        });
    }

    /**
     * Reverte a criação da tabela 'password_reset_tokens'.
     * 
     * Este método é responsável por excluir a tabela 'password_reset_tokens'
     * caso a migration seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};


