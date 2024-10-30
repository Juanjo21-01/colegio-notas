<x-app-layout>
    @section('title', '- Grados y Estudiantes - Editar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('grados-estudiantes.index') }}">Grados y Estudiantes</a></li>
            <li class="breadcrumb-item"><a href="{{ route('grados-estudiantes.edit', $gradoEstudiante->id) }}">Editar
                    Asignación</a>
            </li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Editar Asignación
        </h2>
        <hr class="my-3">

        {{-- Formulario --}}
        <form method="POST" action="{{ route('grados-estudiantes.update', $gradoEstudiante->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Datos del grado --}}
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="text-primary text-lg m-0">Datos</h4>
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
                                        @if (old('grado_id', $gradoEstudiante->grado_id) == $grado->id) selected @endif>
                                        {{ $grado->nombre }} "{{ $grado->seccion }}"</option>
                                @endforeach
                            </select>
                            @error('grado_id')
                                <x-input-error for="grado_id">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <!-- Estudiantes ---->
                        <div class="col">
                            <x-input-label for="estudiante_id"
                                class="form-label
                                ">Estudiante</x-input-label>
                            <select class="form-control" id="estudiante_id" name="estudiante_id">
                                <option value="" disabled>Seleccione un estudiante</option>
                                @foreach ($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}"
                                        @if (old('estudiante_id', $gradoEstudiante->estudiante_id) == $estudiante->id) selected @endif>
                                        {{ $estudiante->codigo_personal }} -
                                        {{ $estudiante->nombres }} {{ $estudiante->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estudiante_id')
                                <x-input-error for="estudiante_id">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones ---->
            <div class="d-flex justify-content-center pt-4">
                <a href="{{ route('grados-estudiantes.index') }}" class="btn btn-danger mr-4"><i
                        class="bi bi-x-lg"></i>
                    Cancelar</a>
                <x-primary-button><i class="bi bi-box-arrow-up"></i> Actualizar </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
