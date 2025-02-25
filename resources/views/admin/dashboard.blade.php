@extends('layouts.layout')

@section('title', 'Dashboard - ' . config('app.name'))

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
    Dashboard
@endsection
