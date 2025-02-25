<?php

/**********************************************************************************
// Migration - Create Product_Item_Variation_Option Table (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'product_item_variation_option', 
//              que estabelece uma relação muitos-para-muitos entre os itens de produtos 
//              e as opções de variações. Essa tabela permite associar cada item de 
//              produto a diferentes combinações de variações (exemplo: um tênis pode 
//              ter variação de cor e tamanho).
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
     * Executa a migration para criar a tabela 'product_item_variation_option'.
     * 
     * Esta tabela permite armazenar a relação entre os itens de produto e suas 
     * respectivas opções de variação. Um item pode ter múltiplas variações, 
     * como cor e tamanho, e cada variação pode ser compartilhada entre diferentes 
     * produtos. 
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('product_item_variation_option', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('variation_option_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverte a criação da tabela 'product_item_variation_option'.
     * 
     * Este método exclui a tabela 'product_item_variation_option' caso a migration seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('product_item_variation_option');
    }
};
