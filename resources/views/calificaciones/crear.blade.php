<x-app-layout>
    @section('title', '- Calificaciones - Crear')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('calificaciones.cursos.index') }}">Calificaciones</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('calificaciones.cursos.create', ['gradoCurso' => $gradoCurso->id]) }}">{{ $gradoCurso->grado->nombre }}
                    "{{ $gradoCurso->grado->seccion }}" - {{ $gradoCurso->curso->nombre }}</a></li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h1 class="text-center text-primary font-weight-bold text-lg mb-3">Ingresar Calificaciones para
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

        {{-- Formulario para guardar calificaciones --}}
        <div class="card shadow mb-4">
            <form action="{{ route('calificaciones.cursos.store') }}" method="POST">
                @csrf
                <div class="card-header d-flex justify-content-between">
                    <h6 class="m-0 p-2 font-weight-bold text-primary">Selecciona la unidad y escribe la nota para cada
                        estudiante.</h6>
                    <!-- Selección de unidad fuera de la tabla -->
                    <div>
                        <x-input-label for="unidad"
                            class="form-label font-weight-bold text-secondary mr-2
                                ">Unidad:</x-input-label>
                        <select id="unidad" name="unidad" class="form-control d-inline w-auto" required>
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
                        {{-- Tabla de estudiantes --}}
                        <table class="table table-bordered max-w-full mt-2">
                            <thead>
                                <tr class="text-center">
                                    <th class="px-4 py-2 col-1">No.</th>
                                    <th class="px-4 py-2 col-2">Código Personal</th>
                                    <th class="px-4 py-2 col-4">Nombre del Estudiante</th>
                                    <th class="px-4 py-2 col-3">Unidad</th>
                                    <th class="px-4 py-2 col-2">Nota</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($estudiantes) == 0)
                                    <tr>
                                        <td class="border px-4 py-2 text-center" colspan="5">No hay estudiantes
                                            asignados
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($estudiantes as $estudiante)
                                    <tr>
                                        <td class="border px-3 py-1 col-1 align-middle text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="border px-3 py-1 col-2 align-middle text-center">
                                            {{ $estudiante->estudiante->codigo_personal }}
                                        </td>
                                        <td class="border px-3 py-1 col-4 align-middle">
                                            {{ $estudiante->estudiante->apellidos }},
                                            {{ $estudiante->estudiante->nombres }}
                                        </td>
                                        {{-- input oculto del estudiante y el grado --}}
                                        <input type="hidden"
                                            name="calificaciones[{{ $estudiante->estudiante->id }}][estudiante_id]"
                                            value="{{ $estudiante->estudiante->id }}">
                                        @error('calificaciones.' . $estudiante->estudiante->id . '.estudiante_id')
                                            <x-input-error
                                                for="calificaciones.{{ $estudiante->estudiante->id }}.estudiante_id">{{ $message }}</x-input-error>
                                        @enderror
                                        <td class="border px-3 py-1 col-3 align-middle text-center">
                                            <input type="text" class="form-control unidadInput" readonly>
                                        </td>
                                        <td class="border px-3 py-1 col-2 align-middle text-center">
                                            <x-text-input type="number" class="form-control"
                                                name="calificaciones[{{ $estudiante->estudiante->id }}][nota]"
                                                value="{{ old('nombres') }}" min="0" max="100" required />
                                            @error('calificaciones.' . $estudiante->estudiante->id . '.nota')
                                                <x-input-error
                                                    for="calificaciones.{{ $estudiante->estudiante->id }}.nota">{{ $message }}</x-input-error>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Botón de guardado --}}
                        <div class="d-flex justify-content-center pt-4">
                            <a href="{{ route('calificaciones.cursos.index') }}" class="btn btn-danger mr-4"><i
                                    class="bi bi-x-lg"></i>
                                Cancelar</a>
                            <x-primary-button><i class="bi bi-box-arrow-up"></i> Guardar Calificaciones
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- JavaScript --}}
        <script>
            document.getElementById('unidad').addEventListener('change', function() {
                const unidadSeleccionada = this.options[this.selectedIndex].text;
                document.querySelectorAll('.unidadInput').forEach(function(input) {
                    input.value = unidadSeleccionada;
                });
            });
        </script>
    </div>
</x-app-layout>
