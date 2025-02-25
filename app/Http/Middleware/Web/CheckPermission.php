<?php

/**********************************************************************************
// CheckPermission (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Middleware responsável por verificar se o usuário autenticado 
//              possui a permissão necessária para acessar uma rota específica.
// 
// Tipo:        Middleware Web
//
**********************************************************************************/

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckPermission
{
    /**
     * Verifica se o usuário autenticado possui a permissão necessária.
     * 
     * Este método intercepta a requisição e verifica se o usuário autenticado 
     * possui a permissão indicada na rota. Se o usuário não tiver permissão, 
     * ele será redirecionado de volta para rota que estava. Caso contrário, 
     * a requisição continua seu fluxo normal.
     * 
     * @param Request $request
     * @param Closure $next
     * @param string $permission
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission): Response|RedirectResponse
    {
        if (!JWTAuth::parseToken()->authenticate()->permissions()->where('name', $permission)->exists()) {
            return redirect()->back();
        }

        return $next($request);
    }
}
