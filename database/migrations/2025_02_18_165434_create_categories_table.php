<?php

/**********************************************************************************
// Migration - Create Categories Table (Código Fonte)
// 
// Criação:     18 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'categories', 
//              que define uma estrutura de categorias de produtos no sistema. 
//
// Tipo:        Migration
//
 **********************************************************************************/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration {

    use SoftDeletes;

    /**
     * Executa a migration para criar a tabela 'categories'.
     * 
     * Esta tabela armazena as categorias de produtos utilizadas no sistema.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverte a criação da tabela 'categories'.
     * 
     * Este método exclui a tabela 'categories' caso a migration seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
