<?php

/**********************************************************************************
// User (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Modelo que representa os usuários no sistema. Ele implementa a 
//              interface JWTSubject para trabalhar com tokens JWT, além de fornecer 
//              métodos para gerenciar permissões do usuário (através de uma relação 
//              muitos-para-muitos com o modelo Permission). O modelo também contém 
//              métodos para atribuir, remover e verificar permissões de um usuário.
// 
// Tipo:        Modelo Eloquent (Autenticável)
// 
 **********************************************************************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Atributos que podem ser atribuídos em massa.
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'telephone_number',
        'password',
    ];

    /**
     * Atributos que devem ser ocultados durante a serialização.
     * 
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Define como os atributos serão convertidos para outros tipos de dados.
     * 
     * @return array
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Estabelece a relação muitos-para-muitos com o modelo Permission.
     * 
     * Este método define que um usuário pode ter várias permissões e que essas 
     * permissões são armazenadas em uma tabela intermediária.
     * 
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Atribui uma permissão ao usuário, caso ainda não tenha.
     * 
     * Este método cria a permissão, se necessário, e a vincula ao usuário.
     * 
     * @param string $permission
     * @return bool
     */
    public function assignPermission(string $permission): bool
    {
        $permission = $this->permissions()->firstOrCreate([
            'name' => $permission,
        ]);

        if (!$this->permissions()->find($permission->id)) {
            $this->permissions()->attach($permission);
            return true;
        }

        return false;
    }


    /**
     * Remove uma permissão do usuário.
     * 
     * Este método remove a permissão associada ao usuário se ela existir.
     * 
     * @param string $permission
     * @return bool
     */
    public function removePermission(string $permission): bool
    {
        $permission = $this->permissions()->where('name', $permission)->first();

        if ($permission) {
            $this->permissions()->detach($permission);
            return true; 
        }

        return false; 
    }


    /**
     * Verifica se o usuário possui uma permissão específica.
     * 
     * Este método verifica se o usuário possui uma permissão com o nome fornecido.
     * 
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->where('name', $permission)->exists();
    }

    /**
     * Retorna o identificador do JWT.
     * 
     * Este método retorna o identificador único do usuário para ser usado no JWT.
     * 
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Retorna os atributos personalizados para o JWT.
     * 
     * Este método permite a adição de qualquer claim customizado ao JWT, caso necessário.
     * 
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
