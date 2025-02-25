<?php

/**********************************************************************************
// AuthMiddleware (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Middleware responsável por validar o token JWT nas requisições 
//              da aplicação web, redirecionando para a página de login caso o 
//              token seja inválido ou ausente.
// 
// Tipo:        Middleware Web
//
**********************************************************************************/

namespace App\Http\Middleware\Web;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class AuthMiddleware
{
    /**
     * Verifica se a requisição contém um token JWT válido.
     * 
     * Este método intercepta a requisição para verificar a presença do token JWT
     * no cabeçalho de autorização ou nos cookies. Caso o token seja encontrado e
     * válido, a requisição continua. Se o token for inválido ou ausente, o usuário
     * é redirecionado para a página de login.
     * 
     * @param Request $request
     * @param Closure $next
     * @return RedirectResponse|Response
     */
    public function handle($request, Closure $next):RedirectResponse|Response 
    {
        if (array_key_exists('token', $_COOKIE)) {
            $request->headers->set('Authorization', 'Bearer ' .  $_COOKIE['token']);
        }

        if (!JWTAuth::getToken() || !JWTAuth::parseToken()->authenticate()) {
            return redirect()->route('web.login');
        }

        return $next($request);
    }
}


