@extends('layouts.layout')

@section('title', 'Perfil - ' . config('app.name'))

@section('header')
    @include('components.header', [
         'shortcuts' => ['return']
    ])
@endsection

@section('content')
    Perfil
@endsection
