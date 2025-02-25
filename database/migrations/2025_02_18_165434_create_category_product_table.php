<?php

/**********************************************************************************
// Migration - Create Category_Product Table (Código Fonte)
// 
// Criação:     18 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'category_product', 
//              que estabelece uma relação muitos-para-muitos entre categorias e 
//              produtos. Essa estrutura permite que um produto pertença a múltiplas 
//              categorias e que uma categoria tenha diversos produtos associados.
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
     * Executa a migration para criar a tabela 'category_product'.
     * 
     * Esta tabela estabelece a relação muitos-para-muitos entre produtos e categorias.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('category_product', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');  
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverte a criação da tabela 'category_product'.
     * 
     * Este método exclui a tabela 'category_product' caso a migration seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};
