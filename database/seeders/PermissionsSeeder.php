<?php

/**********************************************************************************
// PermissionsSeeder (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Seeder responsável por popular a tabela 'permissions' com 
//              dados iniciais, como permissões pré-definidas para a aplicação, 
//              como 'view_dashboard', 'create_products', 'manage_permissions', etc.
// 
// Tipo:        Seeder
//
 **********************************************************************************/

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Executa o seed da tabela de permissões.
     * 
     * Este método é responsável por criar as permissões iniciais que serão usadas 
     * pelos usuários, como visualização de dados, edição, exclusão, etc.
     * 
     * @return void
     */
    public function run()
    {
        $permissions = [
            'delete_products'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
