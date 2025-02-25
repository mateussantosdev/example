<?php

/**********************************************************************************
// GuestMiddleware (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Middleware responsável por verificar se o usuário está 
//              autenticado e redirecioná-lo para a página inicial se já 
//              estiver logado, evitando que usuários autenticados acessem 
//              rotas restritas a convidados.
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

class GuestMiddleware
{
    /**
     * Verifica se o usuário está autenticado e redireciona se necessário.
     * 
     * Este método intercepta a requisição e verifica se o usuário já está autenticado 
     * através de um token JWT. Caso o usuário esteja autenticado, ele será redirecionado 
     * para a página inicial. Caso contrário, a requisição continua o fluxo normal.
     * 
     * @param Request $request
     * @param Closure $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (array_key_exists('token', $_COOKIE)) {
            $request->headers->set('Authorization', 'Bearer ' .  $_COOKIE['token']);
        }

        if (JWTAuth::getToken() && JWTAuth::parseToken()->authenticate()) {
            return redirect()->route('web.home');
        }

        return $next($request);
    }
}
