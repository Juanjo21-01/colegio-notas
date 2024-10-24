<x-app-layout>
    @section('title', '- Estudiantes')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('estudiantes.index') }}">Estudiantes</a></li>
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
            <h6 class="m-0 p-2 font-weight-bold text-primary">Información de los Estudiantes</h6>
            <a href="{{ route('estudiantes.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="bi bi-person-plus-fill"></i>
                </span>
                <span class="text">Crear Nuevo Estudiante</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered max-w-full mt-2">
                    <thead>
                        <tr class="text-center">
                            <th class="px-4 py-2 col-1">No.</th>
                            <th class="px-4 py-2 col-3">Nombres</th>
                            <th class="px-4 py-2 col-2">Código Personal</th>
                            <th class="px-4 py-2 col-1">Género</th>
                            <th class="px-4 py-2 col-1">Estado</th>
                            <th class="px-4 py-2 col-2">Edad</th>
                            <th class="px-4 py-2 col-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($estudiantes) == 0)
                            <tr>
                                <td class="border px-4 py-2 text-center" colspan="7">No hay estudiantes registrados
                                </td>
                            </tr>
                        @endif
                        @foreach ($estudiantes as $estudiante)
                            <tr>
                                <td class="border px-4 py-2 col-1 align-middle">{{ $estudiante->id }}</td>
                                <td class="border px-4 py-2 col-3 align-middle">{{ $estudiante->nombres }}
                                    {{ $estudiante->apellidos }}
                                </td>
                                <td class="border px-4 py-2 col-2 align-middle text-center">
                                    {{ $estudiante->codigo_personal }}</td>
                                <td class="border px-4 py-2 col-1 align-middle text-center">{{ $estudiante->genero }}
                                </td>
                                </td>
                                <td class="border px-4 py-2 col-1 text-center align-middle">
                                    @if ($estudiante->estado == 'estudiando')
                                        <a href="{{ route('estudiantes.cambiar-estado', $estudiante->id) }}"
                                            class="text-white">
                                            <span class="badge badge-success px-3 py-2">Estudiando </span>
                                        </a>
                                    @elseif ($estudiante->estado == 'retirado')
                                        <a href="{{ route('estudiantes.cambiar-estado', $estudiante->id) }}"
                                            class="text-white">
                                            <span class="badge badge-danger px-3 py-2">Retirado </span>
                                        </a>
                                    @elseif ($estudiante->estado == 'graduado')
                                        <a href="{{ route('estudiantes.cambiar-estado', $estudiante->id) }}"
                                            class="text-white">
                                            <span class="badge badge-info px-3 py-2">Graduado </span>
                                        </a>
                                    @elseif ($estudiante->estado == 'repitiendo')
                                        <a href="{{ route('estudiantes.cambiar-estado', $estudiante->id) }}"
                                            class="text-white">
                                            <span class="badge badge-warning px-3 py-2">Repitiendo </span>
                                        </a>
                                    @endif
                                </td>
                                <td class="border px-4 py-2 col-2 align-middle text-center">{{ $estudiante->edad }}
                                    años
                                <td class="border px-4 py-2 col-2 align-middle text-center">
                                    <a href="{{ route('estudiantes.show', $estudiante->id) }}"
                                        class="btn btn-info bg-gradient-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}"
                                        class="btn btn-warning bg-gradient-warning"><i class="bi bi-pencil"></i></a>
                                    <a type="button" class="btn btn-danger bg-gradient-danger " data-bs-toggle="modal"
                                        data-bs-target="#eliminar-estudiante-{{ $estudiante->id }}">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <div class="modal fade" id="eliminar-estudiante-{{ $estudiante->id }}"
                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form method="post" action="{{ route('estudiantes.destroy', $estudiante->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title text-danger text-lg" id="staticBackdropLabel">
                                                    ¿Está seguro de que desea eliminar al estudiante:
                                                    {{ $estudiante->nombres }} {{ $estudiante->apellidos }}?
                                                </h1>
                                                <button type="button" class="btn " data-bs-dismiss="modal"
                                                    aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-danger-emphasis">
                                                    {{ __('Una vez que se elimine al estudiante, todos sus recursos y datos se eliminarán permanentemente. ') }}
                                                </p>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <strong>Nombres:</strong> {{ $estudiante->nombres }}
                                                        {{ $estudiante->apellidos }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>Código Personal:</strong>
                                                        {{ $estudiante->codigo_personal }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>Género:</strong>
                                                        {{ $estudiante->genero == 'M' ? 'Masculino' : 'Femenino' }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>Fecha de Nacimiento:</strong>
                                                        {{ $estudiante->fecha_nacimiento }}
                                                    </li>
                                                </ul>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger bg-gradient">
                                                    {{ __('Eliminar') }}</button>
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
