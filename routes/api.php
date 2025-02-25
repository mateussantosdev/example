<?php

/**********************************************************************************
// api (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Define as rotas da API relacionadas ao controle de autenticação e 
//              permissões do usuário. As rotas são protegidas por middleware 
//              de autenticação e de convidados, garantindo que apenas usuários 
//              autenticados possam acessar rotas restritas.
// 
// Tipo:        Arquivo de configuração de rotas de API
//
 **********************************************************************************/

use App\Http\Controllers\Admin\Api\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\Api\AuthMiddleware;
use App\Http\Middleware\Api\GuestMiddleware;
use App\Http\Controllers\Admin\Api\ProductController;
use App\Http\Middleware\Api\CheckPermission;

/**
 * Grupo de rotas para usuários não autenticados (convidados).
 */
Route::middleware([GuestMiddleware::class])->group(function () {
    /**
     * Rota para login do usuário.
     * 
     * Realiza a autenticação do usuário, gerando um token JWT para futuras requisições.
     * 
     * Método: POST
     * URL: /api/login
     * Controller: AuthController@login
     * Nome da Rota: api.login
     */
    Route::post('login', [AuthController::class, 'login'])->name('api.login');

    /**
     * Rota para registrar um novo usuário.
     * 
     * Cria um novo usuário na plataforma, enviando os dados necessários.
     * 
     * Método: POST
     * URL: /api/register
     * Controller: AuthController@register
     * Nome da Rota: api.register
     */
    Route::post('register', [AuthController::class, 'register'])->name('api.register');
});

/**
 * Grupo de rotas para usuários autenticados.
 */
Route::middleware([AuthMiddleware::class])->group(function () {
    /**
     * Rota para logout do usuário.
     * 
     * Realiza o logout do usuário, invalidando o token JWT.
     * 
     * Método: POST
     * URL: /api/logout
     * Controller: AuthController@logout
     * Nome da Rota: api.logout
     */
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');

    /**
     * Rota para atualizar o token JWT do usuário.
     * 
     * Realiza a renovação do token JWT, permitindo ao usuário continuar autenticado.
     * 
     * Método: POST
     * URL: /api/refresh
     * Controller: AuthController@refresh
     * Nome da Rota: api.refresh
     */
    Route::post('refresh', [AuthController::class, 'refresh'])->name('api.refresh');

    /**
     * Rota para obter os dados do usuário autenticado.
     * 
     * Retorna as informações do usuário autenticado, como nome e email.
     * 
     * Método: GET
     * URL: /api/me
     * Controller: AuthController@me
     * Nome da Rota: api.me
     */
    Route::get('me', [AuthController::class, 'me'])->name('api.me');

    /**
     * Rota para obter as permissões do usuário.
     * 
     * Retorna as permissões associadas ao usuário autenticado.
     * 
     * Método: GET
     * URL: /api/permissions
     * Controller: AuthController@permissions
     * Nome da Rota: api.permissions
     */
    Route::get('permissions', [AuthController::class, 'permissions'])->name('api.permissions');

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('{id}', [ProductController::class, 'show']);

        Route::post('/', [ProductController::class, 'store'])
            ->middleware(CheckPermission::class . ':create_products')
            ->name('api.products.store');

        Route::put('{id}', [ProductController::class, 'update']);
        Route::delete('{id}', [ProductController::class, 'destroy']);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('{id}', [CategoryController::class, 'show']);

        Route::post('/', [CategoryController::class, 'create'])
            ->middleware(CheckPermission::class . ':create_categories')
            ->name('api.categories.create');

        Route::put('{id}', [CategoryController::class, 'update'])
            ->middleware(CheckPermission::class . ':update_categories')
            ->name('api.categories.update');
            
        Route::delete('{id}', [CategoryController::class, 'delete'])
        ->middleware(CheckPermission::class . ':delete_categories')
            ->name('api.categories.update');;
    });
});
