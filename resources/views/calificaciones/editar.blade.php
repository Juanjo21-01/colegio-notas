<x-app-layout>
    @section('title', '- Calificaciones - Editar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('calificaciones.cursos.index') }}">Calificaciones</a></li>
            <li class="breadcrumb-item"><a href="{{ route('calificaciones.cursos.edit', $gradoCurso->id) }}">Editar
                    {{ $gradoCurso->grado->nombre }}
                    "{{ $gradoCurso->grado->seccion }}" - {{ $gradoCurso->curso->nombre }}</a></li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h1 class="text-center text-primary font-weight-bold text-lg mb-3">Editar Calificaciones para
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

        {{-- Formulario para editar calificaciones --}}
        <div class="card shadow mb-4">
            <form method="POST" action="{{ route('calificaciones.cursos.update', $gradoCurso->id) }}">
                @csrf
                @method('PATCH')
                <div class="card-header d-flex justify-content-between">
                    <h6 class="m-0 p-2 font-weight-bold text-primary">Selecciona la unidad que deseas editar y cambia la
                        nota para cada
                        estudiante.</h6>
                    <!-- Selección de unidad fuera de la tabla -->
                    <div>
                        <x-input-label for="unidad"
                            class="form-label font-weight-bold text-secondary mr-2
                                ">Unidad:</x-input-label>
                        <select id="unidad" name="unidad" class="form-control d-inline w-auto">
                            <option value="" selected disabled>Selecciona la Unidad</option>
                            <option value="I">Primera Unidad</option>
                            <option value="II">Segunda Unidad</option>
                            <option value="III">Tercera Unidad</option>
                            <option value="IV">Cuarta Unidad</option>
                        </select>
                        @error('unidad')
                            <x-input-error for="unidad">{{ $message }}</x-input-error>
                        @enderror
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- input oculto del grado y curso --}}
                        <input type="hidden" name="grado_curso_id" value="{{ $gradoCurso->id }}">
                        <table class="table table-bordered max-w-full mt-2">
                            <thead>
                                <tr class="text-center">
                                    <th class="px-4 py-2 text-center align-middle col-1">No.</th>
                                    <th class="px-4 py-2 text-center align-middle col-2">Código Personal</th>
                                    <th class="px-4 py-2 text-center align-middle col-5">Nombre del Estudiante</th>
                                    <th class="px-4 py-2 text-center align-middle col-1">Primera Unidad</th>
                                    <th class="px-4 py-2 text-center align-middle col-1">Segunda Unidad</th>
                                    <th class="px-4 py-2 text-center align-middle col-1">Tercera Unidad</th>
                                    <th class="px-4 py-2 text-center align-middle col-1">Cuarta Unidad</th>
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
                                        <td class="border px-4 py-2 col-1 align-middle text-center">
                                            {{ $loop->iteration }}</td>
                                        <td class="border px-4 py-2 col-2 align-middle text-center">
                                            {{ $datosEstudiante['codigo'] }}</td>
                                        <td class="border px-4 py-2 col-5 align-middle">
                                            {{ $datosEstudiante['estudiante'] }}</td>
                                        {{-- input oculto del estudiante --}}
                                        <input type="hidden" name="calificaciones[{{ $estudianteId }}][estudiante_id]"
                                            value="{{ $estudianteId }}">
                                        @error('calificaciones.' . $estudianteId . '.estudiante_id')
                                            <x-input-error
                                                for="calificaciones.{{ $estudianteId }}.estudiante_id">{{ $message }}</x-input-error>
                                        @enderror
                                        @foreach (['I', 'II', 'III', 'IV'] as $unidad)
                                            <td class="border px-3 py-2 col-1 align-middle text-center">
                                                <x-text-input type="number"
                                                    name="calificaciones[{{ $estudianteId }}][nota]"
                                                    value="{{ $datosEstudiante['calificaciones'][$unidad] }}"
                                                    class="form-control text-center unidad-{{ $unidad }}"
                                                    min="0" max="100" disabled />
                                                @error('calificaciones.' . $estudianteId . '.' . $unidad)
                                                    <x-input-error
                                                        for="calificaciones.{{ $estudianteId }}.{{ $unidad }}">{{ $message }}</x-input-error>
                                                @enderror
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Regresar --}}
                        <div class="d-flex justify-content-center pt-4">
                            <a href="{{ route('calificaciones.cursos.index') }}" class="btn btn-danger mr-4"><i
                                    class="bi bi-arrow-left"></i>
                                Regresar</a>
                            <x-primary-button><i class="bi bi-box-arrow-up"></i> Editar Calificaciones
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- JavaScript --}}
        <script>
            document.getElementById('unidad').addEventListener('change', function() {
                let unidadSeleccionada = this.value;

                document.querySelectorAll('input[type="number"]').forEach(input => {
                    input.disabled = true;
                });

                document.querySelectorAll('.unidad-' + unidadSeleccionada).forEach(input => {
                    input.disabled = false;
                });
            });
        </script>
    </div>
</x-app-layout>
