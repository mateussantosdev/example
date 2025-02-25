<?php

/**********************************************************************************
// Migration - Create Products Table (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'products', 
//              que armazena informações sobre os produtos. 
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
     * Executa a migration para criar a tabela 'products'.
     * 
     * Este método cria a tabela 'products' para armazenar as informações dos 
     * produtos, incluindo campos como 'name' para o nome do produto, 'description' 
     * para uma descrição detalhada, e a chave estrangeiras para  um possível 
     * produto pai (caso seja uma variação ou parte de outro produto).
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->index();
            $table->text('description');
            $table->foreignId('parent_id')->nullable()->constrained('products', 'id')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverte a criação da tabela 'products'.
     * 
     * Este método é responsável por excluir a tabela 'products' caso a migration 
     * seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
