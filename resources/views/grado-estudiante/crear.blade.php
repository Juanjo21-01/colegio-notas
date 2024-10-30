<x-app-layout>
    @section('title', '- Grados y Estudiantes - Crear')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('grados-estudiantes.index') }}">Grados y Estudiantes</a></li>
            <li class="breadcrumb-item"><a href="{{ route('grados-estudiantes.create') }}">Asignar</a></li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Asignar Estudiante a un Grado</h2>
        <hr class="my-3">

        {{-- Formulario --}}
        <form method="POST" action="{{ route('grados-estudiantes.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Datos del estudiante --}}
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-content-center">
                    <h6 class="m-0 p-2 text-lg text-primary">Datos</h6>
                    <a href="{{ route('estudiantes.create') }}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="bi bi-person-plus-fill"></i>
                        </span>
                        <span class="text">Agregar Estudiante</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Grados ---->
                        <div class="col">
                            <x-input-label for="grado_id"
                                class="form-label
                                ">Grado</x-input-label>
                            <select class="form-control" id="grado_id" name="grado_id">
                                <option value="" selected disabled>Seleccione un grado</option>
                                @foreach ($grados as $grado)
                                    <option value="{{ $grado->id }}"
                                        @if (old('grado_id') == $grado->id) selected @endif>
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
                                <option value="" selected disabled>Seleccione un estudiante</option>
                                @foreach ($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}"
                                        @if (old('estudiante_id') == $estudiante->id) selected @endif>
                                        {{ $estudiante->codigo_personal }} -
                                        {{ $estudiante->nombres }}
                                        {{ $estudiante->apellidos }}
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
                <x-primary-button><i class="bi bi-box-arrow-up"></i> Registrar </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
