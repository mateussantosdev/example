<?php

/**********************************************************************************
// Permission (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Modelo que representa as permissões no sistema. As permissões 
//              são atribuídas aos usuários para determinar o acesso a funcionalidades 
//              específicas. Este modelo interage com a tabela de permissões no banco 
//              de dados, permitindo que as permissões sejam manipuladas de forma 
//              programática.
// 
// Tipo:        Model
//
**********************************************************************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

     /**
     * Os atributos que podem ser atribuídos em massa.
     * 
     * Esses campos podem ser preenchidos automaticamente quando uma nova permissão
     * for criada ou atualizada.
     */
    protected $fillable = [
        'name'
    ];
}
