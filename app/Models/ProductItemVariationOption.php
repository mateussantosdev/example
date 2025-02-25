<?php

/**********************************************************************************
// ProductItemVariationOption (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Modelo que representa a tabela de relação entre itens de produtos 
//              e opções de variação. Cada item de produto pode ter múltiplas 
//              variações, como cor e tamanho. Este modelo interage com a 
//              tabela 'product_item_variation_option', facilitando a manipulação 
//              programática dessa relação muitos-para-muitos.
// 
// Tipo:        Model
//
**********************************************************************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductItemVariationOption extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Os atributos que podem ser atribuídos em massa.
     * 
     * Esses campos podem ser preenchidos automaticamente quando uma nova relação
     * entre item de produto e opção de variação for criada ou atualizada.
     */
    protected $fillable = [
        'product_item_id',       
        'variation_option_id',   
    ];

    /**
     * Relacionamento com o item de produto.
     * 
     * Cada relação entre item de produto e variação pertence a um item de produto.
     * 
     * @return BelongsTo
     */
    public function productItem(): BelongsTo
    {
        return $this->belongsTo(ProductItem::class, 'product_item_id');
    }

    /**
     * Relacionamento com a opção de variação.
     * 
     * Cada relação entre item de produto e variação pertence a uma opção de variação.
     * 
     * @return BelongsTo
     */
    public function variationOption(): BelongsTo
    {
        return $this->belongsTo(VariationOption::class, 'variation_option_id');
    }
}
