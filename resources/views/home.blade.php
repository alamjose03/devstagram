@extends('layouts.app')

@section('titulo')
    Página princial
@endsection

@section('contenido')
    {{-- De esta forma se utilizan los componentes: Siempre que se vea un <x- significa que es un componente --}}
    {{-- <x-listar-post>
        <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo>
        <h1>Mostrando post desde slots</h1>
    </x-listar-post> --}}

    {{-- De esta forma se le pasa la variable post hacia el componente --}}
    <x-listar-post :posts="$posts" />
@endsection
