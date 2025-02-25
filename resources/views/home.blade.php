@extends('layouts.layout')

@section('title', 'Home - ' . config('app.name'))


@section('header')
    @include('components.header', [
        'searchBar' => true,
        'navLinks' => [['route' => 'web.home', 'label' => 'Página inicial']],
        'shortcuts' => ['perfil', 'liked-items', 'cart'],
    ])
@endsection

@section('content')
    <h1 class="text-3xl font-bold">Bem-vindo à ShoPperZ!</h1>
    <p class="mt-4 text-gray-600">A melhor loja para encontrar tudo o que você precisa.</p>
@endsection
