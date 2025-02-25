<?php

/**********************************************************************************
// Migration - Create Product_Items Table (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'product_items', 
//              que armazena as informações sobre os itens de um produto.
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
     * Executa a migration para criar a tabela 'product_items'.
     * 
     * Este método cria a tabela 'product_items' para armazenar informações 
     * específicas de cada item de um produto, como o a quantidade disponível em 
     * estoque, e o preço do item. 
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('product_items', function (Blueprint $table): void {
            $table->id();  
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); 
            $table->integer('qty_in_stock');  
            $table->double('price');  
            $table->timestamps();  
            $table->softDeletes();  
        });
    }

    /**
     * Reverte a criação da tabela 'product_items'.
     * 
     * Este método é responsável por excluir a tabela 'product_items' caso a migration 
     * seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('product_items');
    }
};
