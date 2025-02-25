<?php

/**********************************************************************************
// Migration - Create Permissions Table (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'permissions' no banco
//              de dados. Esta tabela armazena as permissões que podem ser atribuídas 
//              aos usuários, permitindo gerenciar os acessos a diferentes funcionalidades 
//              ou áreas da aplicação.
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
     * Executa a migration para criar a tabela 'permissions'.
     * 
     * Este método cria a tabela 'permissions', que armazena as permissões que 
     * podem ser associadas aos usuários, com um campo 'name' que define o nome da 
     * permissão.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverte a criação da tabela 'permissions'.
     * 
     * Este método é responsável por excluir a tabela 'permissions' caso a migration 
     * seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
