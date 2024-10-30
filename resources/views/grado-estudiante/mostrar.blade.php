<x-app-layout>
    @section('title', '- Grados y Estudiantes - Mostrar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('grados-estudiantes.index') }}">Grados y Estudiantes</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('grados-estudiantes.show', $gradoEstudiante->id) }}">
                    {{ $gradoEstudiante->grado->nombre }}
                    "{{ $gradoEstudiante->grado->seccion }}" - {{ $gradoEstudiante->estudiante->nombres }}
                    {{ $gradoEstudiante->estudiante->apellidos }}</a>
            </li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Datos del Grado: {{ $gradoEstudiante->grado->nombre }}
            "{{ $gradoEstudiante->grado->seccion }}" - {{ $gradoEstudiante->estudiante->nombres }}</h2>
        <hr class="my-3">

    </div>
</x-app-layout>
