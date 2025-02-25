<?php

/**********************************************************************************
// AuthMiddleware (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Middleware responsável por garantir que as requisições possuam 
//              um token JWT válido para acesso às rotas protegidas.
// 
//  Tipo:       Middleware API
//
 **********************************************************************************/

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\JsonResponse;

class AuthMiddleware
{
    /**
     * Verifica e valida o token JWT presente na requisição.
     * 
     * Este método intercepta a requisição, checa se um token JWT válido está 
     * presente e autenticado. Se o token for inválido ou ausente, o método retorna
     * uma resposta com código de erro 401 (não autorizado). Se o token for válido, 
     * a requisição continua o fluxo normal, permitindo o acesso à rota.
     * 
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        if (!JWTAuth::getToken() || !JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'Token de acesso inválido'], 401);
        }

        return $next($request);
    }
}
