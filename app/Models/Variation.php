<?php

/**********************************************************************************
// Variation (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Modelo que representa as variações de produtos no sistema. 
//              As variações permitem a diferenciação de um produto, como 
//              cor, tamanho, material, etc. Cada variação pode estar associada 
//              a múltiplos itens de um produto. A tabela 'variations' armazena 
//              as informações sobre essas variações.
// 
// Tipo:        Model
//
**********************************************************************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Variation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Os atributos que podem ser atribuídos em massa.
     * 
     * Esses campos podem ser preenchidos automaticamente quando uma nova variação
     * de produto for criada ou atualizada.
     */
    protected $fillable = [
        'name',  
    ];

    /**
     * Relacionamento com os itens de produto.
     * 
     * Uma variação pode estar associada a vários itens de produto, permitindo
     * que produtos possuam diferentes opções de variação.
     * 
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(ProductItemVariationOption::class, 'variation_id');
    }
}
