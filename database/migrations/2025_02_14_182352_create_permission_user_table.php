<?php

/**********************************************************************************
// Migration - Create Permission_User Table (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'permission_user', 
//              que estabelece uma relação muitos-para-muitos entre os usuários 
//              e as permissões. Cada entrada nesta tabela relaciona um usuário 
//              com uma permissão, permitindo associar múltiplas permissões a 
//              múltiplos usuários.
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
     * Executa a migration para criar a tabela 'permission_user'.
     * 
     * Este método cria a tabela intermediária 'permission_user' que é responsável 
     * por vincular permissões aos usuários, utilizando chaves estrangeiras para 
     * as tabelas 'permissions' e 'users'. Quando um usuário for excluído ou 
     * uma permissão for excluída, os registros relacionados serão removidos automaticamente.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('permission_user', function (Blueprint $table) {
            $table->id();  
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');  
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  
            $table->timestamps();  
        });
    }

    /**
     * Reverte a criação da tabela 'permission_user'.
     * 
     * Este método é responsável por excluir a tabela 'permission_user' caso a migration 
     * seja revertida.
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_user');
    }
};
