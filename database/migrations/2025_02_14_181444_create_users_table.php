<?php

/**********************************************************************************
// Migration - Create Users Table (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'users' no 
//              banco de dados.
// 
// Tipo:        Migration 
//
**********************************************************************************/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    use SoftDeletes; 

    /**
     * Executa a migration para criar a tabela 'users'.
     * 
     * Este método é responsável por definir a estrutura da tabela de usuários, 
     * incluindo campos como nome, email, CPF, número de telefone, senha e a 
     * data de criação/atualização, além de habilitar a exclusão lógica.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();  
            $table->string('name'); 
            $table->string('email')->unique();  
            $table->timestamp('email_verified_at')->nullable();  
            $table->char('cpf', 11)->unique()->nullable();  
            $table->string('telephone_number', 11)->unique()->nullable(); 
            $table->string('password');  
            $table->rememberToken(); 
            $table->timestamps();  
            $table->softDeletes(); 
        });
    }

    /**
     * Reverte a criação da tabela 'users'.
     * 
     * Este método é responsável por excluir a tabela 'users' caso a migration 
     * seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
