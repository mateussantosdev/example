<?php

/**********************************************************************************
// GuestMiddleware (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Middleware que impede o acesso de usuários autenticados 
//              a rotas destinadas a visitantes.
// 
//  Tipo:       Middleware API
//
**********************************************************************************/

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\JsonResponse;

class GuestMiddleware
{
    /**
     * Verifica se o usuário está autenticado e impede o acesso de usuários logados.
     * 
     * Este método intercepta a requisição e, caso um token JWT válido esteja presente 
     * e autenticado, retorna um erro 403 (proibido) para impedir que usuários autenticados 
     * acessem páginas restritas a visitantes. Caso contrário, a requisição segue o fluxo normal.
     * 
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        if (JWTAuth::getToken() && JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'Usuário já autenticado'], 403);
        }

        return $next($request);
    }
}
