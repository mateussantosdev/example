<?php

/**********************************************************************************
// Product (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Modelo que representa os produtos no sistema. Cada produto está 
//              associado a uma categoria e pode ter variações (produtos filhos).
//              Este modelo interage com a tabela 'products' no banco de dados e 
//              permite a manipulação programática das informações dos produtos.
// 
// Tipo:        Model
//
 **********************************************************************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Os atributos que podem ser atribuídos em massa.
     * 
     * Esses campos podem ser preenchidos automaticamente quando um novo produto
     * for criado ou atualizado.
     */
    protected $fillable = [
        'name',
        'description',
        'parent_id',
    ];

     /**
     * Estabelece a relação muitos-para-muitos com o modelo Category.
     * 
     * Este método define que um produto pode ter várias categorias e que essas 
     * categorias são armazenadas em uma tabela intermediária.
     * 
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
