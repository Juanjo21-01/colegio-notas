<x-app-layout>
    @section('title', '- Grados y Cursos - Editar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('grados-cursos.index') }}">Grados y Cursos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('grados-cursos.edit', $gradoCurso->id) }}">Editar Asignación</a>
            </li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Editar Asignación
        </h2>
        <hr class="my-3">

        {{-- Formulario --}}
        <form method="POST" action="{{ route('grados-cursos.update', $gradoCurso->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Datos del grado --}}
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="text-primary text-lg m-0">Datos del Grado</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Grados ---->
                        <div class="col">
                            <x-input-label for="grado_id"
                                class="form-label
                                ">Grado</x-input-label>
                            <select class="form-control" id="grado_id" name="grado_id">
                                <option value="" disabled>Seleccione un grado</option>
                                @foreach ($grados as $grado)
                                    <option value="{{ $grado->id }}"
                                        @if (old('grado_id', $gradoCurso->grado_id) == $grado->id) selected @endif>
                                        {{ $grado->nombre }} "{{ $grado->seccion }}"</option>
                                @endforeach
                            </select>
                            @error('grado_id')
                                <x-input-error for="grado_id">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <!-- Cursos ---->
                        <div class="col">
                            <x-input-label for="curso_id"
                                class="form-label
                                ">Curso</x-input-label>
                            <select class="form-control" id="curso_id" name="curso_id">
                                <option value="" disabled>Seleccione un curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}"
                                        @if (old('curso_id', $gradoCurso->curso_id) == $curso->id) selected @endif>
                                        {{ $curso->nombre }}</option>
                                @endforeach
                            </select>
                            @error('curso_id')
                                <x-input-error for="curso_id">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Datos de los profesores --}}
            <div class="card shadow mt-3">
                <div class="card-header">
                    <h4 class="text-primary text-lg m-0">Datos del Profesor</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Profesores ---->
                        <div class="col">
                            <x-input-label for="user_id"
                                class="form-label
                                ">Profesor</x-input-label>
                            <select class="form-control" id="user_id" name="user_id">
                                <option value="" selected disabled>Seleccione un profesor</option>
                                @foreach ($profesores as $profesor)
                                    <option value="{{ $profesor->id }}"
                                        @if (old('user_id', $gradoCurso->user_id) == $profesor->id) selected @endif>
                                        {{ $profesor->nombres }} {{ $profesor->apellidos }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <x-input-error for="user_id">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones ---->
            <div class="d-flex justify-content-center pt-4">
                <a href="{{ route('grados-cursos.index') }}" class="btn btn-danger mr-4"><i class="bi bi-x-lg"></i>
                    Cancelar</a>
                <x-primary-button><i class="bi bi-box-arrow-up"></i> Actualizar </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
