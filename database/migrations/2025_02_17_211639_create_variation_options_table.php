<?php

/**********************************************************************************
// Migration - Create Variation_Options Table (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'variation_options', 
//              que armazena os valores específicos de cada variação. 
//              Esta tabela é usada para definir opções dentro de uma variação, 
//              como as cores disponíveis para um produto ou os tamanhos possíveis.
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
     * Executa a migration para criar a tabela 'variation_options'.
     * 
     * Esta tabela permite armazenar opções específicas de variações, como as cores 
     * "Vermelho", "Azul", "Verde" dentro da variação "Cor", ou os tamanhos 
     * "P", "M", "G" dentro da variação "Tamanho". 
     * Ela possui um relacionamento com a tabela 'variations' para manter 
     * a referência da qual variação pertence cada opção.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('variation_options', function (Blueprint $table): void {
            $table->id(); 
            $table->string('value');  
            $table->foreignId('variation_id')->constrained()->onDelete('cascade'); 
            $table->timestamps();  
            $table->softDeletes();  
        });
    }

    /**
     * Reverte a criação da tabela 'variation_options'.
     * 
     * Este método exclui a tabela 'variation_options' caso a migration seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('variation_options');
    }
};
