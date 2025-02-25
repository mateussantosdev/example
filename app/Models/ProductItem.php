<?php

/**********************************************************************************
// ProductItem (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Modelo que representa os itens de um produto no sistema. 
//              Cada item de produto está associado a um produto específico 
//              e contém informações como SKU (código único de identificação),
//              quantidade disponível em estoque e preço. A tabela de 
//              'product_items' é usada para gerenciar os dados específicos 
//              de cada variante ou item de um produto.
// 
// Tipo:        Model
//
**********************************************************************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductItem extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Os atributos que podem ser atribuídos em massa.
     * 
     * Esses campos podem ser preenchidos automaticamente quando um novo item
     * de produto for criado ou atualizado.
     */
    protected $fillable = [
        'product_id',
        'sku',
        'qty_in_stock',
        'price',
    ];

    /**
     * Relacionamento com o produto.
     * 
     * Um item pertence a um único produto.
     * 
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
