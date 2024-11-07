<x-app-layout>
    @section('title', '- Calificaciones - Mostrar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('calificaciones.estudiantes') }}">Calificaciones de los
                    Estudiantes</a></li>
            <li class="breadcrumb-item"><a href="{{ route('calificaciones.estudiantes.notas', $grado->id) }}">
                    {{ $grado->nombre }}, Sección "{{ $grado->seccion }}"</a>
            </li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h1 class="text-center text-primary font-weight-bold text-lg mb-3">Estudiantes de
            {{ $grado->nombre }}
            Básico, Sección "{{ $grado->seccion }}"</h1>
        <hr class="my-3">

        {{-- Tabla de estudiantes --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-content-center">
                <h6 class="m-0 p-2 font-weight-bold text-primary">Estudiantes del Grado</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered max-w-full mt-2">
                        <thead>
                            <tr class="text-center">
                                <th class="px-4 py-2 text-center align-middle col-2">No.</th>
                                <th class="px-4 py-2 text-center align-middle col-2">Código Personal</th>
                                <th class="px-4 py-2 text-center align-middle col-5">Nombre del Estudiante</th>
                                <th class="px-4 py-2 text-center align-middle col-3">Notas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($asignacionEstudiantes) == 0)
                                <tr>
                                    <td class="border px-4 py-2 text-center" colspan="3">No hay estudiantes
                                        registrados.
                                    </td>
                                </tr>
                            @endif
                            @foreach ($asignacionEstudiantes as $asignacion)
                                <tr>
                                    <td class="border px-4 py-2 col-2 align-middle text-center">{{ $loop->iteration }}
                                    </td>
                                    <td class="border px-4 py-2 col-2 align-middle text-center">
                                        {{ $asignacion->estudiante->codigo_personal }}</td>
                                    <td class="border px-4 py-2 col-5 align-middle">
                                        {{ $asignacion->estudiante->apellidos }}, {{ $asignacion->estudiante->nombres }}
                                    </td>
                                    <td class="border px-4 py-2 col-3 align-middle text-center">
                                        <a href="{{ route('calificaciones.estudiantes.notas.show', ['idGrado' => $grado->id, 'idEstudiante' => $asignacion->estudiante->id]) }}"
                                            class="btn btn-primary mb-2"> <i class="bi bi-eye"></i>
                                            Ver Notas
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        {{-- Regresar --}}
        <div class="d-flex justify-content-center pt-4">
            <a href="{{ route('calificaciones.estudiantes') }}" class="btn btn-danger mr-4"><i
                    class="bi bi-arrow-left"></i>
                Regresar</a>
        </div>
    </div>
</x-app-layout>
