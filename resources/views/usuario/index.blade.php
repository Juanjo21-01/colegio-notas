<x-app-layout>
    @section('title', '- Usuarios')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
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

    @if (Auth::user()->role->nombre !== 'Profesor')
        {{-- Contenido --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-content-center">
                <h6 class="m-0 p-2 font-weight-bold text-primary">Información de los usuarios</h6>
                @if (Auth::user()->role->nombre === 'Administrador')
                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="bi bi-person-plus-fill"></i>
                        </span>
                        <span class="text">Crear Nuevo Usuario</span>
                    </a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered max-w-full mt-2">
                        <thead>
                            <tr class="text-center">
                                <th class="px-4 py-2 col-1">No.</th>
                                <th class="px-4 py-2 col-3">Nombre</th>
                                <th class="px-4 py-2 col-2">Correo</th>
                                <th class="px-4 py-2 col-1">DPI</th>
                                <th class="px-4 py-2 col-1">Estado</th>
                                <th class="px-4 py-2 col-1">Rol</th>
                                <th class="px-4 py-2 col-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($usuarios) == 0)
                                <tr>
                                    <td class="border px-4 py-2 text-center" colspan="7">No hay usuarios registrados
                                    </td>
                                </tr>
                            @endif
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td class="border px-4 py-2 col-1 align-middle">{{ $usuario->id }}</td>
                                    <td class="border px-4 py-2 col-3 align-middle">{{ $usuario->nombres }}
                                        {{ $usuario->apellidos }}
                                    </td>
                                    <td class="border px-4 py-2 col-2 align-middle">{{ $usuario->email }}</td>
                                    <td class="border px-4 py-2 col-1 align-middle">{{ $usuario->dpi }}</td>
                                    <td class="border px-4 py-2 col-1 text-center align-middle">
                                        @if ($usuario->estado == 'activo')
                                            <a href="{{ route('usuarios.cambiar-estado', $usuario->id) }}"
                                                class="btn text-white {{ $usuario->role->nombre == 'Administrador' ? 'disabled' : '' }}">
                                                <span class="badge badge-success px-3 py-2">Activo </span>
                                            </a>
                                        @else
                                            <a href="{{ route('usuarios.cambiar-estado', $usuario->id) }}"
                                                class="text-white">
                                                <span class="badge badge-danger px-3 py-2">
                                                    Inactivo
                                                </span>
                                            </a>
                                        @endif

                                    </td>
                                    <td class="border px-4 py-2 col-1 align-middle">{{ $usuario->role->nombre }}</td>
                                    <td class="border px-4 py-2 col-3 align-middle text-center">
                                        {{-- <a href="{{ route('usuarios.show', $usuario->id) }}"
                                        class="btn btn-info bg-gradient-info"><i class="bi bi-eye"></i></a> --}}
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                            class="btn btn-warning bg-gradient-warning {{ $usuario->role->nombre === 'Administrador' && Auth::user()->role->nombre !== 'Administrador' ? 'disabled' : '' }}"
                                            {{ $usuario->role->nombre === 'Administrador' && Auth::user()->role->nombre !== 'Administrador' ? 'aria-disabled=true' : '' }}>
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        @if (Auth::user()->role->nombre === 'Administrador')
                                            <a type="button"
                                                class="btn btn-danger bg-gradient-danger {{ $usuario->role->nombre == 'Administrador' ? 'disabled' : '' }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#eliminar-usuario-{{ $usuario->id }}">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="eliminar-usuario-{{ $usuario->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form method="post" action="{{ route('usuarios.destroy', $usuario->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title text-danger text-lg"
                                                        id="staticBackdropLabel">
                                                        ¿Está seguro de que desea eliminar al usuario:
                                                        {{ $usuario->nombres }} {{ $usuario->apellidos }}?
                                                    </h1>
                                                    <button type="button" class="btn " data-bs-dismiss="modal"
                                                        aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-danger-emphasis">
                                                        {{ __('Una vez que se elimine al usuario, todos sus recursos y datos se eliminarán permanentemente. ') }}
                                                    </p>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <strong>Nombre:</strong> {{ $usuario->nombres }}
                                                            {{ $usuario->apellidos }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Correo:</strong> {{ $usuario->email }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Rol:</strong> {{ $usuario->role->nombre }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>DPI:</strong> {{ $usuario->dpi }}
                                                        </li>
                                                    </ul>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-danger bg-gradient">
                                                        {{ __('Eliminar usuario') }}</button>
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
    @else
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900">No tienes permisos para ver esta información</h1>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
