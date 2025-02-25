@extends('layouts.layout')

@section('title', 'Produtos - ' . config('app.name'))

@section('header')
    @include('components.header', [
        'navLinks' => [
            ['route' => 'web.dashboard', 'label' => 'Dashboard'],
            ['route' => 'web.products', 'label' => 'Produtos'],
        ],
        'shortcuts' => ['perfil'],
    ])
@endsection

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md mb-5">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Adicionar Novo Produto</h1>

        <form action="{{ route('api.products.store') }}" method="POST" id="create-product-form">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-medium">Nome</label>
                <input type="text" name="name" id="name" placeholder="Nome do produto"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>


            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-medium">Descrição</label>
                <textarea name="description" id="description" placeholder="Descrição do produto"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>


            <div class="mb-4 flex items-center">
                <input type="checkbox" name="productWithVariation" id="productWithVariation" value="true" class="mr-1">
                <label for="productWithVariation" class="text-gray-700 text-sm font-medium">Produto com variações</label>
            </div>

            <div id="variation-container" class="mb-4 product-items flex space-x-2">
                <div class="flex-1">
                    <label for="prices[]" class="block text-gray-700 text-sm font-medium">Preço</label>
                    <input type="number" step="any" name="prices[]" id="price" placeholder="Preço do produto"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex-1">
                    <label for="stocks[]" class="block text-gray-700 text-sm font-medium">Estoque</label>
                    <input type="number" name="stocks[]" id="stock" placeholder="Quantidade em estoque do produto"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div id="additional-variations"></div>
            <button type="button" id="addVariationBtn"
                class="hidden px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">&plus;</button>

            <!-- Categoria do Produto -->
            <div class="mb-4 mt-2">
                <label for="categories" class="block text-gray-700 text-sm font-medium">Categorias</label>
                <div class="flex space-x-2">
                    <div class="relative w-full">
                        <div class="w-full flex items-center space-x-2">
                            <input type="text" name="searchCategory" id="searchCategory" placeholder="Buscar Categorias"
                                class="flex-grow p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 selectBox">
                            <div class="absolute right-3 text-gray-600">&#x25BC;</div>
                        </div>
                        <div id="checkBoxes" class="absolute w-full bg-white border border-gray-300 mt-1 hidden"
                            style="overflow-y: scroll; height: 9rem;">
                            @foreach ($categories as $category)
                                <label for="category_{{ $category->id }}" class="flex items-center p-2">
                                    <input type="checkbox" name="categories[]" id="category_{{ $category->id }}"
                                        value="{{ $category->id }}" class="mr-2">
                                    <span>{{ $category->name }}</span>
                                    <button type="button"
                                        class="ml-auto text-blue-600 hover:text-blue-800 edit-category">Editar</button>
                                    <button type="button"
                                        class="ml-2 text-red-600 hover:text-red-800 delete-category">Deletar</button>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <button type="button" id="addCategoryBtn"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">+</button>
                </div>
            </div>

            <!-- Botão de Envio -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Adicionar
                    Produto</button>
            </div>
        </form>
    </div>

    <!-- Modal para Adicionar/Alterar Categoria -->
    <div id="categoryModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 id="categoryModalTitle" class="text-lg font-semibold text-gray-800 mb-4">Adicionar Nova Categoria</h2>
            <input type="text" id="CategoryName" placeholder="Nome da Categoria"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <div class="mt-4 flex justify-end space-x-2">
                <button id="cancelCategoryBtn"
                    class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 focus:outline-none">Cancelar</button>
                <button id="saveCategoryBtn"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none">Salvar</button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @vite('resources/js/admin/products.js')
@endpush
