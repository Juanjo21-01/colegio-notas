<x-app-layout>
    @section('title', '- Roles')

    <x-slot name="header">
        <ol class="breadcrumb bg-white mb-0">
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
        </ol>
    </x-slot>

    @if (Auth::user()->role->nombre === 'Administrador')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Información de roles</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered max-w-full mt-2">
                        <thead>
                            <tr class="text-center">
                                <th class="px-4 py-2 col-3">No.</th>
                                <th class="px-4 py-2 col-6">Nombre</th>
                                <th class="px-4 py-2 col-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($roles) == 0)
                                <tr>
                                    <td class="border px-4 py-2 text-center" colspan="3">No hay roles registrados
                                    </td>
                                </tr>
                            @endif
                            @foreach ($roles as $rol)
                                <tr>
                                    <td class="border px-4 py-2 col-3 align-middle">{{ $rol->id }}</td>
                                    <td class="border px-4 py-2 col-6 align-middle">{{ $rol->nombre }}</td>
                                    <td class="border px-4 py-2 col-3 align-middle">
                                        <a href="{{ route('usuarios.index', ['rol' => $rol->nombre]) }}"
                                            class="btn btn-info bg-gradient-info"><i class="bi bi-eye"></i> Ver
                                            Usuarios</a>
                                    </td>
                                </tr>
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
