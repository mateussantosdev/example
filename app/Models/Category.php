<?php

/**********************************************************************************
// Model - Category (Código Fonte)
//
// Criação:     18 Fev 2025
// Atualização: *
//
// Descrição:   Modelo responsável pela representação das categorias de produtos 
//              no sistema.
//
// Tipo:        Model
//
 **********************************************************************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Atributos que podem ser atribuídos em massa.
     * 
     * Esses campos podem ser preenchidos automaticamente quando um novo upload
     * for criado ou atualizado.
     */
    protected $fillable = [
        'name'
    ];
}
