<x-app-layout>
    @section('title', '- Calificaciones - Mostrar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('calificaciones.cursos.index') }}">Calificaciones</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('calificaciones.cursos.show', $gradoCurso->id) }}">{{ $gradoCurso->grado->nombre }}
                    "{{ $gradoCurso->grado->seccion }}" - {{ $gradoCurso->curso->nombre }}</a></li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h1 class="text-center text-primary font-weight-bold text-lg mb-3">Calificaciones de
            {{ $gradoCurso->grado->nombre }}
            Básico, Sección "{{ $gradoCurso->grado->seccion }}"</h1>
        <h2 class="text-secondary text-lg">
            <span class="font-weight-bold"> Curso: </span> {{ $gradoCurso->curso->nombre }}
        </h2>
        <h2 class="text-secondary text-lg">
            <span class="font-weight-bold"> Profesor: </span> {{ $gradoCurso->user->nombres }}
            {{ $gradoCurso->user->apellidos }}
        </h2>
        <hr class="my-3">

        {{-- Tabla de calificaciones --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-content-center">
                <h6 class="m-0 p-2 font-weight-bold text-primary">Calificaciones del Curso:
                    {{ $gradoCurso->curso->nombre }}</h6>
                <a href="{{ route('calificaciones.pdf.curso', $gradoCurso->id) }}" target="_blank"
                    class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="bi bi-filetype-pdf"></i>
                    </span>
                    <span class="text">Descargar</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered max-w-full mt-2">
                        <thead>
                            <tr class="text-center">
                                <th class="px-4 py-2 text-center align-middle col-1">No.</th>
                                <th class="px-4 py-2 text-center align-middle col-2">Código Personal</th>
                                <th class="px-4 py-2 text-center align-middle col-4">Nombre del Estudiante</th>
                                <th class="px-4 py-2 text-center align-middle col-1">Primera Unidad</th>
                                <th class="px-4 py-2 text-center align-middle col-1">Segunda Unidad</th>
                                <th class="px-4 py-2 text-center align-middle col-1">Tercera Unidad</th>
                                <th class="px-4 py-2 text-center align-middle col-1">Cuarta Unidad</th>
                                <th class="px-4 py-2 text-center align-middle col-1">Promedio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($calificacionesPorEstudiante) == 0)
                                <tr>
                                    <td class="border px-4 py-2 text-center" colspan="8">No hay calificaciones
                                        registradas.
                                    </td>
                                </tr>
                            @endif
                            @foreach ($calificacionesPorEstudiante as $estudianteId => $datosEstudiante)
                                <tr>
                                    <td class="border px-4 py-2 col-1 align-middle text-center">{{ $loop->iteration }}
                                    </td>
                                    <td class="border px-4 py-2 col-2 align-middle text-center">
                                        {{ $datosEstudiante['codigo'] }}</td>
                                    <td class="border px-4 py-2 col-4 align-middle">
                                        {{ $datosEstudiante['estudiante'] }}</td>
                                    @foreach (['I', 'II', 'III', 'IV'] as $unidad)
                                        <td
                                            class="border px-4 py-2 col-1 align-middle text-center {{ $datosEstudiante['calificaciones'][$unidad] >= 60 ? 'text-success' : 'text-danger' }}">
                                            {{ $datosEstudiante['calificaciones'][$unidad] }}
                                        </td>
                                    @endforeach
                                    <td
                                        class="border px-4 py-2 col-1 align-middle text-center text-white font-weight-bold {{ $datosEstudiante['promedio'] >= 60 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $datosEstudiante['promedio'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Regresar --}}
        <div class="d-flex justify-content-center pt-4">
            <a href="{{ route('calificaciones.cursos.index') }}" class="btn btn-danger mr-4"><i class="bi bi-arrow-left"></i>
                Regresar</a>
        </div>
    </div>
</x-app-layout>
