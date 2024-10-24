<x-app-layout>
    @section('title', '- Estudiantes - Mostrar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('estudiantes.index') }}">Estudiante</a></li>
            <li class="breadcrumb-item"><a href="{{ route('estudiantes.show', $estudiante->id) }}">{{ $estudiante->nombres }}</a>
            </li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Datos del Estudiante: {{ $estudiante->nombres }}
            {{ $estudiante->apellidos }}</h2>
        <hr class="my-3">

    </div>
</x-app-layout>
