<?php

/**********************************************************************************
// Upload (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Modelo que representa os arquivos carregados no sistema, como 
//              imagens de perfil de usuários e fotos de produtos. A tabela 
//              'uploads' utiliza polimorfismo para associar um arquivo a 
//              diferentes modelos, permitindo que um arquivo seja relacionado 
//              a um produto ou a um usuário. Cada produto pode ter várias 
//              fotos associadas a ele, enquanto um usuário pode ter uma foto 
//              de perfil associada.
// 
// Tipo:        Model
//
 **********************************************************************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Upload extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Atributos que podem ser atribuídos em massa.
     * 
     * Esses campos podem ser preenchidos automaticamente quando um novo upload
     * for criado ou atualizado.
     */
    protected $fillable = [
        'file_path',
        'file_name',
    ];

    /**
     * Relacionamento polimórfico.
     * 
     * Um upload pode ser associado a diferentes modelos (como Produto ou Usuário).
     * Usamos o método 'uploadable' para definir o relacionamento polimórfico,
     * o que permite associar um arquivo tanto a um produto quanto a um usuário.
     * 
     * @return MorphTo
     */
    public function uploadable(): MorphTo
    {
        return $this->morphTo();
    }
}
