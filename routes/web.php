<?php

/**********************************************************************************
// Web Routes (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Define as rotas da aplicação web, incluindo rotas para usuários 
//              não autenticados, autenticados, e para administradores. As rotas 
//              para usuários autenticados são protegidas por middleware de 
//              autenticação e permissões.
// 
// Tipo:        Arquivo de configuração de rotas de web
//
 **********************************************************************************/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Admin\Web\AdminController;
use App\Http\Middleware\Web\AuthMiddleware;
use App\Http\Middleware\Web\GuestMiddleware;
use App\Http\Middleware\Web\CheckPermission;

// Rota para a página inicial da aplicação.
Route::get('/', [UserController::class, 'home'])->name('web.home');

/**
 * Grupo de rotas para usuários não autenticados (convidados).
 */
Route::middleware([GuestMiddleware::class])->group(function () {
    /**
     * Rota para a página de login.
     * 
     * Esta rota é acessível apenas para usuários não autenticados, 
     * redirecionando para a página inicial se o usuário já estiver autenticado.
     * 
     * Método: GET
     * URL: /login
     * Controller: UserController@login
     * Nome da Rota: web.login
     */
    Route::get('/login', [UserController::class, 'login'])->name('web.login');
});

/**
 * Grupo de rotas para usuários autenticados.
 */
Route::middleware([AuthMiddleware::class])->group(function () {
    /**
     * Rota para a página de perfil do usuário.
     * 
     * Esta rota é acessível apenas para usuários autenticados.
     * 
     * Método: GET
     * URL: /perfil
     * Controller: UserController@perfil
     * Nome da Rota: web.perfil
     */
    Route::get('/perfil', [UserController::class, 'perfil'])->name('web.perfil');

    /**
     * Rota para a página de dashboard do administrador.
     * 
     * Esta rota é acessível apenas para administradores que possuam a 
     * permissão 'view_dashboard'. O middleware CheckPermission garante 
     * que apenas usuários com essa permissão possam acessar o dashboard.
     * 
     * Método: GET
     * URL: /dashboard
     * Controller: AdminController@dashboard
     * Nome da Rota: web.dashboard
     * Middleware: CheckPermission::class com permissão 'view_dashboard'
     */
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->middleware(CheckPermission::class . ':view_dashboard')
        ->name('web.dashboard');

       /**
     * Rota para a página de gerenciamento de produtos.
     * 
     * Esta rota é acessível apenas para administradores que possuam a 
     * permissão 'manage_products'. O middleware CheckPermission garante 
     * que apenas usuários com essa permissão possam gerenciar os produtos.
     * 
     * Método: GET
     * URL: /produtos
     * Controller: AdminController@products
     * Nome da Rota: web.products
     * Middleware: CheckPermission::class com permissão 'manage_products'
     */
    Route::get('/produtos', [AdminController::class, 'products'])
        ->middleware(CheckPermission::class . ':manage_products')
        ->name('web.products');

});
