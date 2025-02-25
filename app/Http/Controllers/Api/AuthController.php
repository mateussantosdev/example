<?php

/**********************************************************************************
// AuthController (Código Fonte)
// 
// Criação:     17 Fev 2025
// Atualização: *
// 
// Descrição:   Controlador responsável pelas funcionalidades de autenticação, 
//              incluindo registro de usuários, login, logout e gerenciamento 
//              de permissões.
//
// Tipo:        Controlador API
//
**********************************************************************************/

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    /**
     * @var array
     * 
     * Propriedade que armazena as mensagens de erro personalizadas
     * para a validação dos campos de entrada (como nome, e-mail, senha) 
     * nas requisições de registro e login.
     *
     * @example
     * [
     *     'name.required' => 'O campo nome é obrigatório.',
     *     'email.required' => 'O campo email é obrigatório.',
     *     'password.required' => 'O campo senha é obrigatório.',
     *     // Outras mensagens...
     * ]
     */
    private array $messages = [];

    /**
     * Construtor da classe
     * Define as mensagens de erro personalizadas para validação de campos.
     *
     * @return void
     */
    public function __construct()
    {
        $this->messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser do tipo texto.',
            'name.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email deve ser do tipo texto.',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este email já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'O campo senha deve ser do tipo texto.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.max' => 'A senha não pode ter mais de 255 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'password_confirmation.required' => 'O campo de confirmação de senha é obrigatório.',
        ];
    }

    /**
     * Registra um novo usuário.
     *
     * Realiza a validação dos dados de entrada, cria um novo usuário
     * no banco de dados e retorna uma resposta de sucesso.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed',
        ], $this->messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json(['message' => 'Usuário criado com sucesso'], 201);
    }

    /**
     * Realiza o login do usuário e retorna um token JWT.
     *
     * Valida os dados de login (email e senha) e, caso válidos,
     * retorna um token JWT que pode ser usado para autenticação em requisições subsequentes.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6|max:255',
            ], $this->messages);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $credentials = $request->only('email', 'password');

            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'E-mail e/ou senha inválidos'], 401);
            }

            return response()->json(compact('token'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível efetuar o login, erro interno do servidor, tente novamente mais tarde'], 500);
        }
    }

    /**
     * Retorna as informações do usuário autenticado.
     *
     * Valida o token JWT presente na requisição e retorna os dados do usuário
     * caso o token seja válido.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuário não encontrado'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token de acesso inválido'], 400);
        }

        return response()->json(compact('user'));
    }

    /**
     * Realiza o logout do usuário e invalida o token.
     *
     * Invalida o token JWT, desconectando o usuário da aplicação.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Desconectado com sucesso']);
    }

    /**
     * Retorna as permissões do usuário autenticado.
     *
     * Valida o token JWT e retorna as permissões associadas ao usuário.
     *
     * @return JsonResponse
     */
    public function permissions(): JsonResponse
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuário não encontrado'], 404);
            }

            $permissions = User::find($user->id)->permissions->pluck('name');
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token de acesso inválido'], 400);
        }

        return response()->json(compact('permissions'));
    }
}
