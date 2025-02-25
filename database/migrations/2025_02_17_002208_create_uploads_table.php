<?php

/**********************************************************************************
// Migration - Create Uploads Table (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Migration responsável pela criação da tabela 'uploads', 
//              que armazena informações sobre os arquivos carregados no sistema, 
//              como imagens de perfil de usuários e fotos de produtos. 
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
     * Executa a migration para criar a tabela 'uploads'.
     * 
     * Este método cria a tabela 'uploads', que será responsável por armazenar 
     * os arquivos carregados no sistema. A tabela possui campos como 'file_path', 
     * 'file_name', e usa o polimorfismo (morphs) para associar os arquivos a 
     * diferentes modelos, como usuários ou produtos. Quando o modelo associado 
     * for excluído, os arquivos relacionados também serão removidos automaticamente.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table): void {
            $table->id();
            $table->morphs('uploadable');
            $table->string('file_path');
            $table->string('file_name');
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverte a criação da tabela 'uploads'.
     * 
     * Este método é responsável por excluir a tabela 'uploads' caso a migration 
     * seja revertida.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
