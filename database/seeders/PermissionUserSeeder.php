<?php

/**********************************************************************************
// PermissionUserSeeder (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Seeder responsável por associar permissões aos usuários na tabela 
//              `permission_user`. Ele cria relações entre os usuários e as permissões 
//              definidas no sistema, garantindo que usuários tenham as permissões 
//              necessárias para acessar e realizar ações específicas na aplicação.
// 
// Tipo:        Seeder
//
**********************************************************************************/

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permission;

class PermissionUserSeeder extends Seeder
{
    /**
     * Executa o seed para associar permissões aos usuários.
     * 
     * Este método é responsável por associar as permissões aos usuários existentes no
     * sistema. Ele cria as relações entre a tabela `users` e `permissions`, utilizando
     * a tabela pivô `permission_user` para fazer essas associações. Este seed é 
     * importante para definir as permissões dos usuários no sistema.
     * 
     * @return void
     */
    public function run(): void
    {
        $user = User::where('email', 'mateus.santos0x0@gmail.com')->first();
        if ($user) {
            $permissions = Permission::whereIn('name', ['delete_products'])->get();
            $user->permissions()->attach($permissions);
        }
    }
}
