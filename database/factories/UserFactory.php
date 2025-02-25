<?php

/**********************************************************************************
// UserFactory (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Fábrica responsável pela criação de instâncias de usuários fictícios 
//              para testes e seeding de dados no banco de dados.
// 
// Tipo:        Factory
//
**********************************************************************************/

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define o modelo associado à fábrica.
     * 
     * @var string
     */
    protected $model = User::class;

    /**
     * Definição dos dados fictícios para a criação de um usuário.
     * 
     * Este método retorna os valores padrões que serão usados para criar uma
     * instância de usuário fictício, incluindo nome, email, CPF, número de telefone,
     * senha e outras propriedades.
     * 
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),  // Nome fictício
            'email' => $this->faker->unique()->safeEmail(),  // Email único
            'email_verified_at' => now(),  // Data atual de verificação do email
            'cpf' => $this->faker->unique()->numerify('###########'),  // CPF fictício único
            'telephone_number' => $this->faker->unique()->numerify('###########'),  // Número de telefone fictício único
            'password' => Hash::make('password'),  // Senha hash
            'remember_token' => Str::random(10),  // Token aleatório
            'created_at' => now(),  // Data atual de criação
            'updated_at' => now(),  // Data atual de atualização
            'deleted_at' => null  // Sem exclusão lógica
        ];
    }
}
