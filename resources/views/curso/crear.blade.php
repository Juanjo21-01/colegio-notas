<x-app-layout>
    @section('title', '- Cursos - Crear')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cursos.create') }}">Crear</a></li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Agregar Nuevo Curso</h2>
        <hr class="my-3">

        {{-- Formulario --}}
        <form method="POST" action="{{ route('cursos.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card shadow">
                <div class="card-header">
                    <h4 class="text-primary text-lg m-0">Datos</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Nombre ---->
                        <div class="col">
                            <x-input-label for="nombre" class="form-label">Nombre</x-input-label>
                            <x-text-input type="text" class="form-control" id="nombre" name="nombre"
                                value="{{ old('nombre') }}" />
                            @error('nombre')
                                <x-input-error for="nombre">{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- Botones ---->
            <div class="d-flex justify-content-center pt-4">
                <a href="{{ route('cursos.index') }}" class="btn btn-danger mr-4"><i class="bi bi-x-lg"></i>
                    Cancelar</a>
                <x-primary-button><i class="bi bi-box-arrow-up"></i> Registrar </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
