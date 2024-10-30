<x-app-layout>
    @section('title', '- Cursos - Editar')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cursos.edit', $curso->id) }}">Editar</a></li>
        </ol>
    </x-slot>

    <div class="px-4 pb-4">
        <h2 class="text-primary font-weight-bold text-lg">Editar Curso </h2>
        <hr class="my-3">

        {{-- Formulario --}}
        <form method="POST" action="{{ route('cursos.update', $curso->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

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
                                value="{{ old('nombre', $curso->nombre) }}" />
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
                <x-primary-button><i class="bi bi-box-arrow-up"></i> Actualizar </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
