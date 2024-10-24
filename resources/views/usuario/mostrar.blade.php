<x-app-layout>
    @section('title', '- Usuarios - Mostrar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuario</a></li>
            <li class="breadcrumb-item"><a href="{{ route('usuarios.show', $usuario->id) }}">{{ $usuario->nombres }}</a>
            </li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Datos del Usuario: {{ $usuario->nombres }}
            {{ $usuario->apellidos }}</h2>
        <hr class="my-3">

    </div>
</x-app-layout>
