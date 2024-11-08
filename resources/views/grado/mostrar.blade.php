<x-app-layout>
    @section('title', '- Grados - Notas')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('grados.index') }}">Grados</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('grados.show', ['id' => $grado->id, 'unidad' => $unidad]) }}">
                    {{ $grado->nombre }} Básico, Sección
                    "{{ $grado->seccion }}"</a>
            </li>
        </ol>
    </x-slot>

    {{-- Titulo --}}
    <h1 class="text-center text-primary font-weight-bold text-lg mb-3">{{ $grado->nombre }}
        Básico, Sección "{{ $grado->seccion }}"</h1>
    <hr class="my-3">


    {{-- Tabla de calificaciones --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-content-center">
            <h6 class="m-0 p-2 font-weight-bold text-primary">
                @if ($unidad == 'I')
                    Primera
                @elseif ($unidad == 'II')
                    Segunda
                @elseif ($unidad == 'III')
                    Tercera
                @elseif ($unidad == 'IV')
                    Cuarta
                @endif
                Evaluación Parcial {{ date('Y') }}
            </h6>
            <a href="{{ route('calificaciones.pdf.grado', ['id' => $grado->id, 'unidad' => $unidad]) }}" target="_blank"
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
                    <thead style="font-size: 0.8rem;">
                        <tr class="text-center">
                            <th class="px-2 py-1 text-center align-middle" style="width: 0%">No.</th>
                            <th class="px-2 py-1 text-center align-middle col-2">Estudiante</th>
                            <th class="px-2 py-1 text-center align-middle" style="width: 0%">Género</th>
                            @foreach ($cursos as $curso)
                                <th class="px-2 py-1 text-center align-middle col-1">
                                    {{ $curso->curso->nombre }}</th>
                            @endforeach
                            <th class="px-2 py-1 text-center align-middle" style="width: 0%">Promedio</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.8rem;">
                        @foreach ($calificacionesPorEstudiante as $datosEstudiante)
                            <tr>
                                <td class="border px-2 py-1 align-middle text-center" style="width: 0%">
                                    {{ $loop->iteration }}</td>
                                <td class="border px-2 py-1 align-middle col-2" style="font-size: 0.9rem;">
                                    {{ $datosEstudiante['estudiante']->apellidos }},
                                    {{ $datosEstudiante['estudiante']->nombres }}</td>
                                <td class="border px-2 py-1 align-middle text-center" style="width: 0%">
                                    {{ $datosEstudiante['estudiante']->genero }}</td>
                                @foreach ($cursos as $curso)
                                    <td class="border px-2 py-1 align-middle text-center col-1 {{ is_numeric($datosEstudiante['calificaciones'][$curso->curso->nombre]) && $datosEstudiante['calificaciones'][$curso->curso->nombre] >= 60 ? 'text-success' : 'text-danger' }}"
                                        style="width: 0%">
                                        {{ $datosEstudiante['calificaciones'][$curso->curso->nombre] }}
                                    </td>
                                @endforeach
                                <td
                                    class="border px-2 py-1 align-middle text-center text-white font-weight-bold {{ is_numeric($datosEstudiante['promedio']) && $datosEstudiante['promedio'] >= 60 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $datosEstudiante['promedio'] }}
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
        <a href="{{ route('grados.index') }}" class="btn btn-danger mr-4"><i class="bi bi-arrow-left"></i> Regresar</a>
    </div>
</x-app-layout>
