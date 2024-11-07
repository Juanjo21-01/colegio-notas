<x-app-layout>
    @section('title', '- Calificaciones - Grado')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('calificaciones.estudiantes') }}">Calificaciones de los
                    Estudiantes</a></li>
            <li class="breadcrumb-item"><a href="{{ route('calificaciones.estudiantes.notas', $grado->id) }}">
                    {{ $grado->nombre }}, Sección "{{ $grado->seccion }}"</a>
            </li>
            <li class="breadcrumb-item"><a
                    href="{{ route('calificaciones.estudiantes.notas.show', [$grado->id, $estudiante->id]) }}">
                    {{ $estudiante->nombres }} {{ $estudiante->apellidos }}</a>
            </li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h1 class="text-center text-primary font-weight-bold text-lg mb-3">Boleta de Calificaciones</h1>
        <h2 class="text-secondary text-lg">
            <span class="font-weight-bold"> Estudiante: </span> {{ $estudiante->nombres }}
            {{ $estudiante->apellidos }}
        </h2>
        <h2 class="text-secondary text-lg">
            <span class="font-weight-bold"> Grado: </span> {{ $grado->nombre }}
            Básico, Sección "{{ $grado->seccion }}"
        </h2>

        <hr class="my-3">

        {{-- Tabla de calificaciones --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-content-center">
                <h6 class="m-0 p-2 font-weight-bold text-primary">Calificaciones de: {{ $estudiante->nombres }}
                    {{ $estudiante->apellidos }}</h6>
                <a href="{{ route('calificaciones.pdf.estudiante', [$grado->id, $estudiante->id]) }}" target="_blank"
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
                                <th class="px-4 py-2 text-center align-middle col-6">Curso</th>
                                <th class="px-4 py-2 text-center align-middle col-1">Primera Unidad</th>
                                <th class="px-4 py-2 text-center align-middle col-1">Segunda Unidad</th>
                                <th class="px-4 py-2 text-center align-middle col-1">Tercera Unidad</th>
                                <th class="px-4 py-2 text-center align-middle col-1">Cuarta Unidad</th>
                                <th class="px-4 py-2 text-center align-middle col-1">Promedio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($calificacionesPorCurso) == 0)
                                <tr>
                                    <td class="border px-4 py-2 text-center" colspan="7">No hay calificaciones
                                        registradas.
                                    </td>
                                </tr>
                            @endif
                            @foreach ($calificacionesPorCurso as $cursoNombre => $datosCurso)
                                @php
                                    $promedioCurso = $datosCurso['promedio'];
                                    $totalPromedio += $promedioCurso;
                                @endphp
                                <tr>
                                    <td class="border px-4 py-2 align-middle col-1 text-center">
                                        {{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2 align-middle col-6">{{ $cursoNombre }}</td>
                                    @foreach (['I', 'II', 'III', 'IV'] as $unidad)
                                        <td
                                            class="border px-4 py-2 align-middle col-1 text-center {{ $datosCurso['calificaciones'][$unidad] >= 60 ? 'text-success' : 'text-danger' }}">
                                            {{ $datosCurso['calificaciones'][$unidad] }}
                                        </td>
                                    @endforeach
                                    <td
                                        class="border px-4 py-2 align-middle col-1 text-center text-white font-weight-bold {{ $promedioCurso >= 60 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $promedioCurso }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6"
                                    class="border px-4 py-2 align-middle text-center font-weight-bold text-uppercase">
                                    Promedio General</td>
                                <td
                                    class="border px-4 py-2 align-middle text-center text-white font-weight-bold {{ $totalPromedio / $totalCursos >= 60 ? 'bg-success' : 'bg-danger' }}">
                                    {{ round($totalPromedio / $totalCursos) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Regresar --}}
        <div class="d-flex justify-content-center pt-4">
            <a href="{{ route('calificaciones.estudiantes.notas', $grado->id) }}" class="btn btn-danger mr-4"><i
                    class="bi bi-arrow-left"></i>
                Regresar</a>
        </div>
    </div>
</x-app-layout>
