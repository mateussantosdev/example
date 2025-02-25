<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * @var array
     * 
     * Propriedade que armazena as mensagens de erro personalizadas
     * para a validação dos campos de entrada (como o id).
     *
     * @example
     * [
     *     'id.required' => 'O campo ID da categoria é obrigatório.',
     *     'id.integer' => 'O campo ID da categoria deve ser um número inteiro.',
     *     // Outras mensagens...
     * ]
     */
    private array $messages = [];

    public function __construct()
    {
        $this->messages = [
            'name.required' => 'O nome da categoria é obrigatório',
            'name.max' => 'O nome da categoria não pode ter mais de 255 caracteres',
            'name.string' => 'O nome da categoria deve ser do tipo texto',
            'id.required' => 'O ID da categoria é obrigatório',
            'id.numeric' => 'O ID da categoria deve ser um número',
        ];
    }

    public function index() {}

    public function create(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ], $this->messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                ], 400);
            }

            $category = Category::create([
                'name' => $request->input('name')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Categoria criada com sucesso',
                'data' => [
                    'category' => $category
                ],
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível criar a categoria. Erro interno do servidor, tente novamente mais tarde',
            ], 500);
        }
    }


    public function show() {}

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $validator = Validator::make(array_merge($request->all(), ['id' => $id]), [
                'id' => 'required|numeric',
                'name' => 'required|string|max:255',
            ], $this->messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                ], 400);
            }

            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Categoria não encontrada',
                ], 404);
            }

            $category->update([
                'name' => $request->input('name')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Categoria atualizada com sucesso',
                'data' => [
                    'category' => $category
                ],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível atualizar a categoria. Erro interno do servidor, tente novamente mais tarde',
            ], 500);
        }
    }



    public function delete(int $id): JsonResponse
    {
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|numeric',
            ], $this->messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                ], 400);
            }

            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Categoria não encontrada',
                ], 404);
            }

            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Categoria deletada com sucesso'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível atualizar a categoria. Erro interno do servidor, tente novamente mais tarde',
            ], 500);
        }
    }
}
