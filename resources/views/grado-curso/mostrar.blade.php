<x-app-layout>
    @section('title', '- Grados y Cursos - Mostrar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('grados-cursos.index') }}">Grados y Cursos</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('grados-cursos.show', $gradoCurso->id) }}">{{ $gradoCurso->grado->nombre }}
                    "{{ $gradoCurso->grado->seccion }}" - {{ $gradoCurso->curso->nombre }}</a>
            </li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Datos del Grado: {{ $gradoCurso->grado->nombre }}
            "{{ $gradoCurso->grado->seccion }}" - {{ $gradoCurso->curso->nombre }}</h2>
        <hr class="my-3">

    </div>
</x-app-layout>
