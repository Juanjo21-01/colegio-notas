<x-app-layout>
    @section('title', '- Estudiantes - Crear')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('estudiantes.index') }}">Estudiantes</a></li>
            <li class="breadcrumb-item"><a href="{{ route('estudiantes.create') }}">Crear</a></li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Agregar Nuevo Estudiante</h2>
        <hr class="my-3">

        {{-- Formulario --}}
        <form method="POST" action="{{ route('estudiantes.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Datos personales --}}
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="text-primary text-lg m-0">Datos Personales</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Nombres ---->
                        <div class="col">
                            <x-input-label for="nombres" class="form-label">Nombres</x-input-label>
                            <x-text-input type="text" class="form-control" id="nombres" name="nombres"
                                value="{{ old('nombres') }}" />
                            @error('nombres')
                                <x-input-error for="nombres">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <!-- Fecha de Nacimiento ---->
                        <div class="col">
                            <x-input-label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</x-input-label>
                            <x-text-input type="date" class="form-control" id="fecha_nacimiento"
                                name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" />
                            @error('fecha_nacimiento')
                                <x-input-error for="fecha_nacimiento">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Apellidos ---->
                        <div class="col">
                            <x-input-label for="apellidos" class="form-label">Apellidos</x-input-label>
                            <x-text-input type="text" class="form-control" id="apellidos" name="apellidos"
                                value="{{ old('apellidos') }}" />
                            @error('apellidos')
                                <x-input-error for="apellidos">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <!-- Género ---->
                        <div class="col">
                            <x-input-label for="genero" class="form-label">Género</x-input-label>
                            {{-- input radio --}}
                            <div class="d-flex">
                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="radio" name="genero" id="masculino"
                                        value="M" {{ old('genero') == 'M' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="masculino">Masculino</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="genero" id="femenino"
                                        value="F" {{ old('genero') == 'F' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="femenino">Femenino</label>
                                </div>
                            </div>
                            @error('genero')
                                <x-input-error for="genero">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            {{-- Datos del colegio --}}
            <div class="card shadow mt-3">
                <div class="card-header">
                    <h4 class="text-primary text-lg m-0">Datos del Establecimiento</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Codigo Personal ---->
                        <div class="col">
                            <x-input-label for="codigo_personal" class="form-label">Código Personal</x-input-label>
                            <x-text-input type="text" class="form-control" id="codigo_personal"
                                name="codigo_personal" value="{{ old('codigo_personal') }}" />
                            @error('codigo_personal')
                                <x-input-error for="codigo_personal">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones ---->
            <div class="d-flex justify-content-center pt-4">
                <a href="{{ route('estudiantes.index') }}" class="btn btn-danger mr-4"><i class="bi bi-x-lg"></i>
                    Cancelar</a>
                <x-primary-button><i class="bi bi-box-arrow-up"></i> Registrar </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
