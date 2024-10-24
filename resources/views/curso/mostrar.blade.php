<x-app-layout>
    @section('title', '- Cursos - Mostrar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Curso</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cursos.show', $curso->id) }}">{{ $curso->nombre }}</a></li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Datos del Curso: {{ $curso->nombre }} </h2>
        <hr class="my-3">

    </div>
</x-app-layout>
