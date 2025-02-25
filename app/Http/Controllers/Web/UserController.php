<?php

/**********************************************************************************
// UserController (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Controlador responsável pelas funcionalidades relacionadas 
//              ao usuário, como exibição de página inicial, login e perfil. 
//              Algumas das funcionalidades desse controlador podem ser usadas 
//              pelo adminsitardor em prol de não gerar duplicidade de código.
//
//  Tipo:       Controlador web
//
**********************************************************************************/

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Exibe a página inicial para o usuário.
     * 
     * Esta função é responsável por retornar a visão da página inicial onde o
     * usuário pode visualizar o conteúdo geral do sistema.
     *
     * @return  View
     */
    public function home(): View
    {
        return view('home');
    }

    /**
     * Exibe a página de login para o usuário.
     * 
     * Esta função retorna a visão da página de login onde o usuário pode
     * inserir suas credenciais para acessar o sistema.
     *
     * @return View
     */
    public function login(): View
    {
        return view('login');
    }

    /**
     * Exibe a página de perfil do usuário.
     * 
     * Esta função retorna a visão do perfil onde o usuário pode visualizar
     * e editar suas informações pessoais dentro do sistema.
     *
     * @return View
     */
    public function perfil(): View
    {
        return view('perfil');
    }
}
