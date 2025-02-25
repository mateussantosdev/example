<?php

/**********************************************************************************
// CheckPermission (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Middleware responsável por verificar se o usuário autenticado 
//              possui a permissão necessária para acessar uma rota específica na API.
//              Esse middleware é usado para garantir que apenas usuários com as permissões
//              adequadas possam acessar determinadas funcionalidades da aplicação.
// 
// Tipo:        Middleware API
//
**********************************************************************************/

namespace App\Http\Middleware\API;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckPermission
{
    /**
     * Verifica se o usuário autenticado possui a permissão necessária para acessar a rota.
     * 
     * Este método intercepta a requisição de uma rota protegida e verifica se o usuário autenticado 
     * (por meio do token JWT) tem a permissão especificada para acessar o recurso. Caso o usuário 
     * não tenha a permissão, ele receberá uma resposta de erro com o código HTTP 403 (Proibido).
     * Caso o usuário tenha permissão, a requisição segue para o próximo middleware ou ação do controller.
     * 
     * @param Request $request
     * @param Closure $next
     * @param string $permission
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next, $permission): JsonResponse
    {
        if (!JWTAuth::parseToken()->authenticate()->permissions()->where('name', $permission)->exists()) {
            return response()->json(['error' => 'Usuário não tem permissão para realizar esta ação'], 403);
        }

        return $next($request);
    }
}
