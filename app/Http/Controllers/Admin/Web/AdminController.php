<?php

/**********************************************************************************
// AdminController (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Controlador responsável pela gestão das funcionalidades 
//              administrativas, como exibição do dashboard e outras operações 
//              relacionadas ao admin.
//
// Tipo:        Contolador web
//
**********************************************************************************/

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class AdminController extends Controller
{

    /**
     * Exibe o painel de controle do administrador.
     * 
     * Esta função é responsável por retornar a visão do dashboard administrativo.
     * O dashboard serve como uma visão central para o administrador acessar as 
     * funcionalidades e dados importantes do sistema.
     *
     * @return View
     */
    public function dashboard(): View
    {
        return view('admin/dashboard');
    }

    public function products(): View {

        $categories = Category::all();

        return view('admin/products', compact('categories'));
    }
}
