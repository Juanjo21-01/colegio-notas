<x-app-layout>
    @section('title', '- Grados y Estudiantes')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('grados-estudiantes.index') }}">Grados y Estudiantes</a></li>
        </ol>
    </x-slot>

    {{-- Mensajes --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
            <strong class="p-2">{{ session('success') }}</strong>
            <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close"><i
                    class="bi bi-x-lg"></i></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
            <strong class="p-2">{{ session('error') }}</strong>
            <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close"><i
                    class="bi bi-x-lg"></i></button>
        </div>
    @endif

    {{-- Contenido --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-content-center">
            <h6 class="m-0 p-2 font-weight-bold text-primary">Información de los Grados con los Estudiantes</h6>
            <a href="{{ route('grados-estudiantes.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="bi bi-journal-plus"></i>
                </span>
                <span class="text">Nueva Asignación</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered max-w-full mt-2">
                    <thead>
                        <tr class="text-center">
                            <th class="px-4 py-2 col-1">No.</th>
                            <th class="px-4 py-2 col-2">Grado</th>
                            <th class="px-4 py-2 col-4">Estudiante</th>
                            <th class="px-4 py-2 col-2">Encargado</th>
                            <th class="px-4 py-2 col-1">Estado</th>
                            <th class="px-4 py-2 col-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($gradosEstudiantes) == 0)
                            <tr>
                                <td class="border px-4 py-2 text-center" colspan="6">No hay grados y estudiantes
                                    registrados
                                </td>
                            </tr>
                        @endif
                        @foreach ($gradosEstudiantes as $gradoEstudiante)
                            <tr>
                                <td class="border px-4 py-2 col-1 align-middle text-center">{{ $gradoEstudiante->id }}
                                </td>
                                <td class="border px-4 py-2 col-2 align-middle">{{ $gradoEstudiante->grado->nombre }}
                                    "{{ $gradoEstudiante->grado->seccion }}"</td>
                                <td class="border px-4 py-2 col-4 align-middle">
                                    {{ $gradoEstudiante->estudiante->codigo_personal }} -
                                    {{ $gradoEstudiante->estudiante->apellidos }},
                                    {{ $gradoEstudiante->estudiante->nombres }}</td>
                                <td class="border px-4 py-2 col-2 align-middle"> {{ $gradoEstudiante->user->nombres }}
                                    {{ $gradoEstudiante->user->apellidos }}
                                <td class="border px-4 py-2 col-1 text-center align-middle">
                                    @if ($gradoEstudiante->estado == 'activo')
                                        <a href="{{ route('grados-estudiantes.cambiar-estado', $gradoEstudiante->id) }}"
                                            class="text-white">
                                            <span class="badge badge-success px-3 py-2">Activo </span>
                                        </a>
                                    @else
                                        <a href="{{ route('grados-estudiantes.cambiar-estado', $gradoEstudiante->id) }}"
                                            class="text-white">
                                            <span class="badge badge-danger px-3 py-2">
                                                Inactivo
                                            </span>
                                        </a>
                                    @endif
                                </td>
                                <td class="border px-4 py-2 col-2 align-middle text-center">
                                    <a href="{{ route('grados-estudiantes.show', $gradoEstudiante->id) }}"
                                        class="btn btn-info bg-gradient-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('grados-estudiantes.edit', $gradoEstudiante->id) }}"
                                        class="btn btn-warning bg-gradient-warning"><i class="bi bi-pencil"></i></a>
                                    <a type="button" class="btn btn-danger bg-gradient-danger " data-bs-toggle="modal"
                                        data-bs-target="#eliminar-gradoEstudiante-{{ $gradoEstudiante->id }}">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <div class="modal fade" id="eliminar-gradoEstudiante-{{ $gradoEstudiante->id }}"
                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form method="post"
                                        action="{{ route('grados-estudiantes.destroy', $gradoEstudiante->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title text-danger text-lg" id="staticBackdropLabel">
                                                    ¿Está seguro de que desea eliminar la asignación del grado:
                                                    {{ $gradoEstudiante->grado->nombre }}
                                                    "{{ $gradoEstudiante->grado->seccion }}"
                                                </h1>
                                                <button type="button" class="btn " data-bs-dismiss="modal"
                                                    aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-danger-emphasis">
                                                    {{ __('Una vez que se elimine la asignación, todos sus recursos y datos se eliminarán permanentemente. ') }}
                                                </p>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <strong>Grado:</strong> {{ $gradoEstudiante->grado->nombre }}
                                                        "{{ $gradoEstudiante->grado->seccion }}"
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>Estudiante:</strong>
                                                        {{ $gradoEstudiante->estudiante->nombres }}
                                                        {{ $gradoEstudiante->estudiante->apellidos }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>Profesor:</strong>
                                                        {{ $gradoEstudiante->user->nombres }}
                                                        {{ $gradoEstudiante->user->apellidos }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger bg-gradient">
                                                    {{ __('Eliminar Asignación') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
