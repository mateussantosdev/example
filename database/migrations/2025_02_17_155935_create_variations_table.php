<?php

/**********************************************************************************
// Migration - Create Variations Table (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'variations', 
//              que armazena as variações de produtos, como cor, tamanho, 
//              material, entre outros atributos que diferenciam um item de outro.
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
     * Executa a migration para criar a tabela 'variations'.
     * 
     * Este método cria a tabela 'variations' que armazena as variações de produtos, 
     * permitindo que cada variação tenha um nome descritivo (como "Cor", "Tamanho", etc.).
     * A tabela também suporta exclusão lógica através do SoftDeletes, garantindo 
     * que registros removidos possam ser recuperados se necessário.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('variations', function (Blueprint $table): void {
            $table->id();  
            $table->string('name');  
            $table->timestamps(); 
            $table->softDeletes();  
        });
    }

    /**
     * Reverte a criação da tabela 'variations'.
     * 
     * Este método é responsável por excluir a tabela 'variations' caso a migration 
     * seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('variations');
    }
};
