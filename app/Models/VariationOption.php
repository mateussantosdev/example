<?php

/**********************************************************************************
// VariationOption (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Modelo que representa as opções dentro de uma variação de produto 
//              no sistema. Cada variação pode ter múltiplas opções, como "Vermelho", 
//              "Azul", "P", "M", "G" para variações como "Cor" ou "Tamanho". 
//              Esse modelo interage com a tabela 'variation_options' no banco 
//              de dados, permitindo a manipulação programática das opções das variações.
// 
// Tipo:        Model
//
**********************************************************************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariationOption extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Os atributos que podem ser atribuídos em massa.
     * 
     * Esses campos podem ser preenchidos automaticamente quando uma nova opção
     * de variação for criada ou atualizada.
     */
    protected $fillable = [
        'value',  
        'variation_id',  
    ];

    /**
     * Relacionamento com a variação.
     * 
     * Cada opção pertence a uma única variação de produto.
     * 
     * @return BelongsTo
     */
    public function variation(): BelongsTo
    {
        return $this->belongsTo(Variation::class);
    }
}
